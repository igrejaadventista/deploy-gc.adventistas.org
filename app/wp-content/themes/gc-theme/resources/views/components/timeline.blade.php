<infinite-scroll
  class="timeline w-full px-4 mx-auto max-w-container relative mt-6 md:mt-16 flex flex-col
  before:content-[''] before:absolute before:w-1 before:top-4 before:h-[110%] before:bg-primary
  after:content-['...'] after:text-secondary after:font-bold after:text-center after:text-2xl after:mt-2 after:md:mt-4"
  url="{{ get_rest_url(null, 'wp/v2/timeline') }}"
  args="_fields=date,title,content"
  trigger="#timeline-trigger"
>

  <div id="timeline-trigger" class="absolute bottom-0 w-full h-80 -z-10"></div>

  <template id="timeline-title">
    <h2
      class="timeline-title text-secondary text-2xl md:text-[32px] md:leading-10 p-4 md:py-3 border-l-8 border-primary bg-gradient-to-r from-primary/20 to-primary/0 mb-6 mt-4"
    >
      @translate('Notícias de') <span class="timeline-title__day font-bold">@translate('hoje')</span>
    </h2>
  </template>

  <template id="timeline-manual-site">
    <article class="mb-12 md:mb-14">
      <div class="border-l-8 border-secondary pl-4">
        <x-time class="text-right mt-4">@translate('às') <span class="timeline-item-time"></span></x-time>

        <h3 class="timeline-item-title text-secondary font-bold text-xl md:text-2xl"></h3>
      </div>

      <div class="pl-6 flex flex-col mt-2">
        <div class="bg-[#F8F9FB] rounded-lg overflow-hidden">
          <img class="w-full aspect-thumbnail object-cover" src="@asset('images/timeline-01.png')" alt="Abertura do evento">

          <div class="p-4 md:p-6">
            <div class="timeline-item-description text-sm md:text-base text-grey empty:hidden"></div>

            <a class="btn-secondary py-2 px-3 text-sm mt-4 md:mt-6" href="#">
              @translate('Ler mais')<img class="ml-2 h-3" src="@asset('images/arrow-down.svg')" alt="@translate('Seta para baixo')">
            </a>
          </div>
        </div>
      </div>
    </article>
  </template>

  <template id="timeline-embed">
    <article class="mb-12 md:mb-14">
      <div class="border-l-8 border-secondary pl-4">
        <x-time class="text-right mt-4">@translate('às') <span class="timeline-item-time"></span></x-time>

        <h3 class="timeline-item-title text-secondary font-bold text-xl md:text-2xl"></h3>
      </div>

      <div class="pl-6 mt-3">
        <div class="timeline-item-embed"></div>
      </div>
    </article>
  </template>
</infinite-scroll>
