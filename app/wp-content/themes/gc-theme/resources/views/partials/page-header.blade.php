@php
  $live = true;
@endphp

<section class="w-full relative flex justify-start flex-col items-center pt-14 pb-4 md:pt-4">
  <img
    class="w-full absolute top-0 left-0 object-cover -z-10 {{ $live ? 'h-[90%] md:h-[69%]' : 'h-full' }}"
    src="@asset('images/page-header.jpg')"
    alt="{{ __('Imagem de fundo') }}"
  >

  <img class="h-14 md:h-20 mb-2 mt-24 md:mt-40" src="@asset('images/page-header-logo.png')" alt="{{ __('Uma igreja em movimento') }}">

  @if($live)
    <div class="live w-full px-4 max-w-container mt-7 md:mt-20">
      <h4
        class="before:content-[''] before:w-4 before:h-4 before:bg-[#FF0000] before:flex before:rounded-full before:shadow-lg before:shadow-[#ff000066] before:mr-3 before:md:mr-2
        flex items-center text-primary font-bold text-sm md:text-base mb-4 justify-center md:justify-start"
      >
        Ao vivo | Abertura da GC &#178;&#8304;&#178;&#178;
      </h4>

      <div class="aspect-video rounded-lg overflow-hidden shadow-xl">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/IHEbht3ZcPQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    </div>
  @endif
</section>
