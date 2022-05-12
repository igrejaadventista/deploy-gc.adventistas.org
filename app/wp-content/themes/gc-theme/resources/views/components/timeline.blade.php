<section
  class="timeline w-full px-4 mx-auto max-w-container relative mt-6 md:mt-16 flex flex-col
  before:content-[''] before:absolute before:w-1 before:top-4 before:h-[110%] before:bg-primary
  after:content-['...'] after:text-secondary after:font-bold after:text-center after:text-2xl after:mt-2 after:md:mt-4"
>
  <h2
    class="text-secondary text-2xl md:text-[32px] md:leading-10 p-4 md:py-3 border-l-8 border-primary bg-gradient-to-r from-primary/20 to-primary/0 mb-6 mt-4"
  >
    Notícias de <span class="font-bold">hoje</span>
  </h2>

  <article class="mb-12 md:mb-14">
    <div class="border-l-8 border-secondary pl-4">
      <h4 class="text-primary font-bold text-xs">às 23:00</h4>

      <h3 class="text-secondary font-bold text-xl md:text-2xl">Abertura do evento</h3>
    </div>

    <div class="pl-6 flex flex-col">
      <img class="w-full rounded-lg aspect-thumbnail object-cover mt-4 md:order-2" src="@asset('images/timeline-01.png')" alt="Abertura do evento">

      <p class="mt-3 md:mt-2 text-sm md:text-base text-grey">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nibh ipsum, facilisis ac vehicula ut, interdum eget lacus. Maecenas faucibus cursus tellus nec pellentesque. Aenean blandit est eu ultrices sagittis.
      </p>
    </div>
  </article>

  <article class="mb-12 md:mb-14">
    <div class="border-l-8 border-secondary pl-4">
      <h4 class="text-primary font-bold text-xs">às 18:00</h4>

      <h3 class="text-secondary font-bold text-xl md:text-2xl">Saudação do Pr. Ted Wilson</h3>
    </div>

    <div class="pl-6 mt-3">
      <div class="aspect-video-lg rounded-lg overflow-hidden">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/i8d6R-3ITPI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  </article>

  <h2
    class="text-secondary text-2xl md:text-[32px] md:leading-10 p-4 md:py-3 border-l-8 border-primary bg-gradient-to-r from-primary/20 to-primary/0 mb-6 mt-4"
  >
    Notícias de <span class="font-bold">05/04</span>
  </h2>

  <article class="mb-12 md:mb-14">
    <div class="border-l-8 border-secondary pl-4">
      <h4 class="text-primary font-bold text-xs">às 18:00</h4>

      <h3 class="text-secondary font-bold text-xl md:text-2xl">Orientação 1</h3>
    </div>

    <div class="pl-6 flex flex-col mt-2">
      <div class="p-4 md:p-6 bg-[#F8F9FB] rounded-lg">
        <p class="text-sm md:text-base text-grey">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nibh ipsum, facilisis ac vehicula ut, interdum eget lacus. Maecenas faucibus cursus tellus nec pellentesque. Aenean blandit est eu ultrices sagittis.
        </p>

        <p class="mt-4 text-sm md:text-base text-grey">
          <b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nibh ipsum</b>, facilisis ac vehicula ut, interdum eget lacus.
        </p>

        <a class="btn-secondary py-2 px-3 text-sm mt-4 md:mt-6" href="#">
          Ler mais<img class="ml-2 h-3" src="@asset('images/arrow-down.svg')" alt="{{ __('Seta para baixo') }}">
        </a>
      </div>
    </div>
  </article>
</section>
