export default class Live {

  constructor() {
    this.pageHeader = document.getElementById('page-header');
    this.spacer     = document.getElementById('page-header-spacer');
    this.page       = this.pageHeader?.dataset.page;
    this.threshold  = 0.3;
    this.live = {
      container:           document.getElementById('live-container'),
      title:               document.getElementById('live-title'),
      description:         document.getElementById('live-description'),
      player:              null,
      previousTitle:       '',
      previousPlayer:      '',
      previousDescription: '',
    };
    this.observers = {
      pageHeader: new IntersectionObserver((entries) => this.onScrollDown(entries[0]), {threshold: this.threshold}),
      spacer:     new IntersectionObserver((entries) => this.onScrollUp(entries[0]), {threshold: this.threshold}),
    };

    this.live.previousTitle        = this.live.title?.innerHTML;
    this.live.previousPlayer       = this.live.container?.dataset.video;
    this.live.previousDescription  = this.live.title?.innerHTML;

    this.connectObservers();

    if(typeof window.YT === 'undefined' || !window.YT.loaded)
      window.onYouTubeIframeAPIReady = () => this.initPlayer();
    else
      this.initPlayer();
  }

  initPlayer() {
    this.live.player = new window.YT.Player('live-player', {
      videoId: this.live.previousPlayer,
      events: {
        'onReady': () => this.onPlayerReady(),
      },
    });

    if(this.live.container && this.page)
      setInterval(() => this.checkLive(), 3000);
  }

  onPlayerReady() {
    this.live.player.mute();
    this.live.player.playVideo();
  }

  connectObservers() {
    this.observers.pageHeader.observe(this.pageHeader);
    this.observers.spacer.observe(this.spacer);
  }

  disconnectObservers() {
    this.observers.pageHeader.unobserve(this.pageHeader);
    this.observers.spacer.unobserve(this.spacer);
  }

  refreshObservers() {
    this.disconnectObservers();
    this.connectObservers();
  }

  onScrollDown({isIntersecting, intersectionRatio}) {
    if(!this.pageHeader.classList.contains('has-live'))
      return;

    if(!isIntersecting && intersectionRatio < this.threshold && !this.pageHeader.classList.contains('page-header--fixed')) {
      this.spacer.style.height = `${this.pageHeader.clientHeight}px`;
      this.pageHeader.classList.add('page-header--fixed');
    }
  }

  onScrollUp({isIntersecting, intersectionRatio}) {
    if(!this.pageHeader.classList.contains('has-live') && !this.pageHeader.classList.contains('remove-live'))
      return;

    if((isIntersecting && intersectionRatio > this.threshold && this.pageHeader.classList.contains('page-header--fixed')) ||
      this.pageHeader.classList.contains('remove-live')) {
      this.spacer.style.height = '0px';
      this.pageHeader.classList.remove('page-header--fixed');
      this.pageHeader.classList.remove('remove-live');
    }
  }

  checkLive() {
    fetch(this.page)
      .then((data) => data.json())
      .then((data) => {
        const live = data?.acf?.live;

        this.refreshTitle(live);
        this.refreshPlayer(live);
        this.refreshDescription(live);
        this.refreshStatus(live);
        console.log(live.title);

      });
  }

  refreshStatus(live) {
    if(this.live.player.getPlayerState() == 1 && !live.enabled && this.pageHeader?.classList.contains('has-live'))
      this.live.player.pauseVideo();
    else if(this.live.player.getPlayerState() != 1 && live.enabled && !this.pageHeader?.classList.contains('has-live'))
      this.live.player.playVideo();

    this.pageHeader?.classList.toggle('remove-live', this.pageHeader?.classList.contains('has-live') && !live.enabled);
    this.pageHeader?.classList.toggle('has-live', live.enabled);
    this.live.container?.classList.toggle('hidden', !live.enabled);
    this.refreshObservers();
  }

  refreshTitle(live) {
    if(!this.live.title || this.live.previousTitle == live.title)
      return;

    this.live.previousTitle = live.title;
    this.live.title.innerHTML = live.title;
  }

  refreshPlayer(live) {
    const currentVideo = this.live.player?.getVideoData()['video_id'];

    if(!this.live.player || live.videoID == currentVideo)
      return;

    this.live.previousPlayer = live.videoID;
    this.live.player.loadVideoById(live.videoID);
  }

  refreshDescription(live) {
    if(!this.live.description || this.live.previousDescription == live.description)
      return;

    this.live.previousDescription   = live.description;
    this.live.description.innerHTML = live.description;
  }

}
