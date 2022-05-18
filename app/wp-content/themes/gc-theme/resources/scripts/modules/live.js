export default class Live {

  constructor() {
    this.pageHeader = document.getElementById('page-header');
    this.spacer     = document.getElementById('page-header-spacer');
    this.threshold  = 0.3;
    this.live = {
      container:     document.getElementById('live-container'),
      title:         document.getElementById('live-title'),
      player:        document.getElementById('live-player'),
      previousTitle: '',
      previousPlayer: '',
    };
    this.observers = {
      pageHeader: new IntersectionObserver((entries) => this.onScrollDown(entries[0]), {threshold: this.threshold}),
      spacer:     new IntersectionObserver((entries) => this.onScrollUp(entries[0]), {threshold: this.threshold}),
    };

    this.live.previousTitle  = this.live.title?.innerHTML;
    this.live.previousPlayer = this.live.player?.src;

    this.connectObservers();

    if(this.live.container)
      setInterval(() => this.checkLive(), 3000);
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
    fetch(`http://localhost/wp-json/wp/v2/pages/48`)
      .then((data) => data.json())
      .then((data) => {
        const live = data?.acf?.live;

        this.refreshTitle(live);
        this.refreshPlayer(live);
        this.refreshStatus(live);
      });
  }

  refreshStatus(live) {
    this.pageHeader?.classList.toggle('has-live', live.enabled);
    this.pageHeader?.classList.toggle('remove-live', !live.enabled);
    this.live.container?.classList.toggle('hidden', !live.enabled);
    this.refreshObservers();
    // this.live.player?.contentWindow.postMessage(`{"event":"command","func":"${live.enabled ? 'playVideo' : 'pauseVideo' }","args":""}`, '*');
  }

  refreshTitle(live) {
    if(!this.live.title || this.live.previousTitle == live.title)
      return;

    this.live.previousTitle = live.title;
    this.live.title.innerHTML = live.title;
  }

  refreshPlayer(live) {
    const url = new URL(this.live.previousPlayer);
    const player = `/embed/${live.videoID}`;

    if(!this.live.player || url.pathname == player)
      return;


    url.pathname = player;
    url.searchParams.delete('mute');
    console.log(url.toString());


    this.live.previousPlayer = url.toString();
    this.live.player.src = url.toString();

    // setTimeout(() => {
      this.live.player?.contentWindow.postMessage(`{"event":"command","func":"playVideo","args":""}`, '*');
    // }, 5000);

  }

}
