<header class="bg-black/20 py-10 lg:py-[22px] px-3.5 lg:px-9 flex items-center justify-between">
  <a class="z-10" href="{{ home_url('/') }}">
    <img class="h-16 lg:h-12" src="@asset('images/logo-site.svg')" alt="{{ __('Logo General Conference') }}">
  </a>

  @if(has_nav_menu('primary_navigation'))
    <input id="menu-toggler" class="hidden" type="checkbox" autocomplete="off">

    <label for="menu-toggler" class="cursor-pointer flex items-center text-primary font-bold text-xs px-2 py-3 bg-[#424A5E52] rounded-lg lg:hidden z-10">
      <div class="mr-1.5 grid content-between h-3">
        <span class="h-0.5 rounded-sm bg-primary w-5 block"></span>
        <span class="h-0.5 rounded-sm bg-primary w-5 block"></span>
        <span class="h-0.5 rounded-sm bg-primary w-5 block"></span>
      </div>
      menu
    </label>

    <nav class="fixed lg:relative top-0 left-full bottom-0 pt-36 lg:pt-0 bg-secondary lg:bg-transparent w-full lg:w-auto transition-all" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
      {!!
        wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class'     => 'flex flex-col lg:flex-row',
          'container'      => false,
          'echo'           => false,
          'item_classes'   => 'ml-6 font-bold uppercase text-[#E5E5E5] hover:underline text-sm',
        ])
      !!}
    </nav>
  @endif
</header>
