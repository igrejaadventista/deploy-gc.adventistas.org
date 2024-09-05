<section
  id="page-header"
  class="page-header w-full relative flex justify-start flex-col items-center py-4 transition-all top-[-100%] {{ $isOn ? 'has-live' : '' }}"
  data-page="{{ $page }}"
>
  <img
    class="background w-full absolute top-0 left-0 object-cover -z-10 h-full"
    src="@asset('images/page-header.jpg')"
    alt="<?php _e('Imagem de fundo', 'gc') ?>"
  >

  <img
    class="logo h-14 md:h-20 mb-2 mt-36 md:mt-40"
    src="{{ \App\translateImage('page-header-logo.png') }}"
    alt="<?php _e('Uma igreja em movimento', 'gc') ?>"
  >

  @istrue($isTimeline)
    <div id="live-container" class="live w-full px-4 max-w-container mt-7 md:mt-20 {{ !$isOn ? 'hidden' : '' }}" data-video="{{ $ID }}">
      <h4
        id="live-title"
        class="live__title before:content-[''] before:w-4 before:max-w-[16px] before:h-4 before:bg-[#FF0000] before:flex before:rounded-full
        before:shadow-lg before:shadow-[#ff000066] before:mr-3 before:md:mr-2 before:basis-auto before:shrink-0 before:grow
        flex items-center text-primary font-bold text-sm md:text-base mb-4 justify-center md:justify-start order-last"
      >
        {!! $title !!}
      </h4>

      <div class="live__player rounded-lg aspect-video overflow-hidden shadow-xl basis-auto shrink-0 grow bg-black relative">
        <div id="live-player"></div>
      </div>

      <p id="live-description" class="live__description mt-4 text-[#5E5E5E] text-base hidden md:block">{!! $description !!}</p>
    </div>
  @endistrue
</section>

<div id="page-header-spacer"></div>
