<header class="bg-black/20 lg:py-[22px] px-9 flex items-center justify-between">
  <a href="{{ home_url('/') }}">
    <img class="h-12" src="@asset('images/logo-site.svg')" alt="{{ __('Logo General Conference') }}">
  </a>

  @if(has_nav_menu('primary_navigation'))
    <nav aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
      {!!
        wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class'     => 'flex',
          'container'      => false,
          'echo'           => false,
          'item_classes'   => 'ml-6 font-bold uppercase text-[#E5E5E5] hover:underline text-sm',
        ])
      !!}
    </nav>
  @endif
</header>
