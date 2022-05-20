export default class Timeline {

  constructor() {
    this.element = document.querySelector('infinite-scroll');
    this.dates = [];
    this.formatDate = new Intl.DateTimeFormat('default', { month: '2-digit', day: '2-digit' });
    this.formatTime = new Intl.DateTimeFormat('default', { hour: '2-digit', minute: '2-digit' });
    this.templates = {
      date: this.element.querySelector('#timeline-title')?.content,
      manual: this.element.querySelector('#timeline-manual')?.content,
    }

    this.element.addEventListener('loadData', (event) => this.parseData(event.detail));
  }

  parseData(data) {
    if(!Array.isArray(data))
      return;

    console.log(data);

    data.forEach((item) => {
      this.parseDate(item);

      switch(item.acf?.content[0]?.acf_fc_layout) {
        case 'manual':
          this.buildManualItem(item);
          break;
      }
    });
  }

  parseDate(data) {
    const date = (new Date(data.date)).withoutTime();

    if(this.dates.includes(date))
      return;

    this.dates.push(date);

    const element = this.templates.date?.cloneNode(true);

    if(!date.isToday())
      element.querySelector('.timeline-title__day').textContent = this.formatDate.format(date);

    this.element.appendChild(element);
  }

  buildManualItem(data) {
    console.log(data);

    const element = this.templates.manual?.cloneNode(true);

    this.buildItemTime(element, data);
    this.buildItemTitle(element, data);
    this.buildItemDescription(element, data);

    this.element.appendChild(element);
  }

  buildItemTime(elementItem, data) {
    const element = elementItem.querySelector('.timeline-item-time');

    if(!element)
      return;

    element.innerHTML = this.formatTime.format(new Date(data.date));
  }

  buildItemTitle(elementItem, data) {
    const element = elementItem.querySelector('.timeline-item-title');

    if(!element)
      return;

    element.innerHTML = data.title.rendered;
  }

  buildItemDescription(elementItem, data) {
    const element = elementItem.querySelector('.timeline-item-description');

    if(!element || !data.acf?.content[0]?.description)
      return;

    element.innerHTML = data.acf?.content[0]?.description;
  }

}
