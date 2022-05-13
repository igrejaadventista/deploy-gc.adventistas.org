<article class="w-full px-4 mx-auto max-w-container-content pt-6 md:pt-9 pb-14 md:pb-24">
  <header class="w-full flex flex-col pb-2 mb-6 border-b border-grey-light">
    <h1 class="text-2xl md:text-[2.5rem] md:leading-[3rem] font-bold text-secondary block">@title</h1>

    <time class="text-primary font-bold text-xs text-right mt-4">@published</time>
  </header>

  <section class="flex flex-col">
    @content
  </section>

  <footer class="w-full flex justify-between border-t border-grey-light mt-6 md:mt-2 pt-10">
    <a class="btn-grey p-[18px]" href="#" onclick="event.preventDefault(); window.scrollTo({ top: 0, behavior: 'smooth' });">
      <img src="@asset('images/arrow-up.svg')" alt="{{ __('Seta para cima') }}">
    </a>

    <a class="btn-secondary py-3 px-6 text-base" href="{{ get_home_url() }}">Acessar notícias</a>
  </footer>
</article>
