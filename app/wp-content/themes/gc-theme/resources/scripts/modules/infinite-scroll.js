class InfiniteScroll extends HTMLElement {

  constructor() {
    // establish prototype chain
    super();

    this.url = this.getAttribute('url');

    if(!this.isUrl())
      return;

    this.totalPages = 0;
    this.args = (this.args = this.getAttribute('args')).startsWith('?') ? this.args : `?${this.args}`;
    this.method = this.method = this.getAttribute('method') ? this.method.toUpperCase() : 'GET';
    this.nonce = this.getAttribute('nonce') || '';
    this.url = new URL(`${this.url}${this.args}`);

    if(this.args)
      this.loadMoreData();
  }

  registerObserver() {
    this.trigger = this.querySelector(this.attributes.getNamedItem('trigger')?.nodeValue);

    if(!this.trigger)
      return;

    this.observer = new IntersectionObserver(
      (entries) => {
        if(entries[0].isIntersecting)
          this.loadMoreData();
      },
      { threshold: [0] }
    );

    this.observer.observe(this.trigger);
  }

  loadMoreData() {
    this.url.searchParams.set('page', this.url.searchParams.has('page') ? parseInt(this.url.searchParams.get('page')) + 1 : 1);

    const args = {
      method: this.method,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
      },
    };

    if(this.nonce)
      args.headers['X-WP-Nonce'] = this.nonce;

    fetch(this.method == 'GET' ? this.url.href : `${this.url.origin}${this.url.pathname}`, args)
      .then((data) => {
        if(this.totalPages == 0)
          this.totalPages = parseInt(data.headers.get('X-WP-TotalPages'));
        if(!this.observer)
          this.registerObserver();
        if(this.totalPages == parseInt(this.url.searchParams.get('page')))
          this.observer.unobserve(this.trigger);

        return data.json();
      })
      .then((data) => this.parseData(data));

    // request.send(this.method != 'GET' ? this.url.search.substring(1) : '');
  }

  parseData(data) {
    if(!Array.isArray(data))
      return;

    this.dispatchEvent(new CustomEvent('loadData', { detail: data }));
  }

  isUrl() {
    try { return Boolean(new URL(this.url)); }
    catch(e){ return false; }
  }

}

customElements.define('infinite-scroll', InfiniteScroll);
