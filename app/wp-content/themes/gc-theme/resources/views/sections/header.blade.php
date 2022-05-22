<header class="bg-transparent md:bg-[#1C2430] h-36 md:h-[92px] px-3.5 md:px-9 flex items-center justify-between absolute w-full z-10">
  @if(has_custom_logo())
    {!! the_custom_logo() !!}
  @endif

  @if(has_nav_menu('primary_navigation'))
    <input id="menu-toggler" class="hidden" type="checkbox" autocomplete="off">

    <label for="menu-toggler" class="cursor-pointer flex items-center text-primary font-bold text-xs px-2 py-3 bg-[#424A5E52] rounded-lg md:hidden z-10 ml-auto">
      <div class="mr-1.5 grid content-between h-3 transition-all">
        <span class="h-0.5 rounded-sm bg-primary w-5 block transition-all"></span>
        <span class="h-0.5 rounded-sm bg-primary w-5 block transition-all"></span>
        <span class="h-0.5 rounded-sm bg-primary w-5 block transition-all"></span>
      </div>
      @translate('menu')
    </label>

    <nav
      class="fixed md:relative top-0 left-full md:left-0 bottom-0 pt-36 md:pt-0 bg-secondary md:bg-transparent w-full md:w-auto transition-all flex justify-center ml-auto"
      aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}"
    >
      {!!
        wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class'     => 'flex flex-col md:flex-row',
          'container'      => false,
          'echo'           => false,
          'item_classes'   => 'md:ml-6 font-bold uppercase text-[#E5E5E5] hover:underline text-sm flex justify-center',
          'link_classes'   => 'py-4',
        ])
      !!}
    </nav>
  @endif
</header>
