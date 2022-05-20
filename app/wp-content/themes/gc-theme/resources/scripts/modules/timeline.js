export default class Timeline {

  constructor() {
    this.element = document.querySelector('infinite-scroll');
    this.dates = [];
    this.formatDate = new Intl.DateTimeFormat('default', { month: '2-digit', day: '2-digit' });
    this.templates = {
      date: this.element.querySelector('#timeline-title')?.content,
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
        case 'site':
          this.buildSiteCard(item);
          break;
      }
    });
  }

  parseDate(data) {
    const date = (new Date(data.date)).withoutTime();

    if(this.dates.includes(date))
      return;

    this.dates.push(date);

    const dateElement = this.templates.date?.cloneNode(true);

    if(!date.isToday())
      dateElement.querySelector('.timeline-title__day').textContent = this.formatDate.format(date);

    this.element.appendChild(dateElement);
  }

  buildSiteCard(data) {
    console.log(data);
  }

}
