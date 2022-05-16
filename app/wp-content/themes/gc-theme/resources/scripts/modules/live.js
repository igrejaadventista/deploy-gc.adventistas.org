export default class Live {

  constructor() {
    this.element = document.getElementById('page-header');
    this.spacer = document.getElementById('page-header-spacer');
    this.threshold = 0.3;

    (new IntersectionObserver((entries) => this.onScrollDown(entries[0]), {threshold: this.threshold})).observe(this.element);
    (new IntersectionObserver((entries) => this.onScrollUp(entries[0]), {threshold: this.threshold})).observe(this.spacer);

    setInterval(() => this.checkLive(), 3000);
  }

  onScrollDown({isIntersecting, intersectionRatio}) {
    if(!this.element.classList.contains('has-live'))
      return;

    if(!isIntersecting && intersectionRatio < this.threshold && !this.element.classList.contains('page-header--fixed')) {
      this.spacer.style.height = `${this.element.clientHeight}px`;
      this.element.classList.add('page-header--fixed');
    }
  }

  onScrollUp({isIntersecting, intersectionRatio}) {
    if(!this.element.classList.contains('has-live'))
      return;

    if(isIntersecting && intersectionRatio > this.threshold && this.element.classList.contains('page-header--fixed')) {
      this.spacer.style.height = '0px';
      this.element.classList.remove('page-header--fixed');
    }
  }

  checkLive() {
    console.log(123);
  }

}
