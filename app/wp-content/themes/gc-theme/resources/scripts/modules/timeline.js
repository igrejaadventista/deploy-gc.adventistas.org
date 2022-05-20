export default class Timeline {

  constructor() {
    this.element = document.querySelector('infinite-scroll');

    this.element.addEventListener('loadData', (event) => {
      console.log('loadData', event);
    });
  }

}
