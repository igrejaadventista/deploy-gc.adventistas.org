export default class Timeline {

  constructor() {
    this.element = document.querySelector('infinite-scroll');
    this.dates = [];
    this.formatDate = new Intl.DateTimeFormat('default', { month: '2-digit', day: '2-digit' });
    this.formatTime = new Intl.DateTimeFormat('default', { hour: '2-digit', minute: '2-digit' });
    this.templates = {
      date: this.element.querySelector('#timeline-title')?.content,
      manual: this.element.querySelector('#timeline-manual-site')?.content,
      site: this.element.querySelector('#timeline-manual-site')?.content,
      embed: this.element.querySelector('#timeline-embed')?.content,
      html: this.element.querySelector('#timeline-html')?.content,
    }

    console.log(this.element.querySelector('#timeline-html'));
    this.element.addEventListener('loadData', (event) => this.parseData(event.detail));
  }

  parseData(data) {
    if(!Array.isArray(data))
      return;

    data.forEach((item) => {
      this.buildDate(item);

      let element = this.templates[item.content?.acf_fc_layout]?.cloneNode(true);

      console.log(this.templates);

      this.buildItem(element, item);
    });
  }

  buildDate(data) {
    const date = (new Date(data.date)).withoutTime();

    if(this.dates.includes(this.formatDate.format(date)))
      return;

    this.dates.push(this.formatDate.format(date));

    const element = this.templates.date?.cloneNode(true);

    if(!date.isToday())
      element.querySelector('.timeline-title__day').textContent = this.formatDate.format(date);

    this.element.appendChild(element);
  }

  buildItem(element, data) {
    this.buildItemTime(element, data);
    this.buildItemTitle(element, data);
    this.buildItemThumbnail(element, data);
    this.buildItemDescription(element, data);
    this.buildItemEmbed(element, data);
    this.buildItemLink(element, data);

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

    element.innerHTML = data.content?.title !== undefined ? data.content.title : data.title.rendered;
  }

  buildItemThumbnail(elementItem, data) {
    const element = elementItem.querySelector('.timeline-item-thumbnail');

    if(!element || !data.content?.image)
      return;

    element.src = data.content.image;
    element.alt = data.content?.title;
  }

  buildItemDescription(elementItem, data) {
    const element = elementItem.querySelector('.timeline-item-description');

    if(!element || !data.content?.description)
      return;

    element.innerHTML = data.content?.description;
  }

  buildItemEmbed(elementItem, data) {
    const element = elementItem.querySelector('.timeline-item-embed');

    if(!element)
      return;

    const newContent = document.createRange().createContextualFragment(data.content?.url);
    element.appendChild(newContent);

    if(data.content?.url.includes('youtube') || data.content?.url.includes('vimeo'))
      element.classList.add('aspect-video')
  }

  buildItemLink(elementItem, data) {
    const element = elementItem.querySelector('.timeline-item-link');

    if(!element || !data.content?.url)
      return;

    element.href = data.content?.url;
  }

}
