<header class="bg-black/20 lg:py-[22px] px-9 flex items-center">
  <a class="brand" href="{{ home_url('/') }}">
    <img class="h-12" src="@asset('images/logo-site.svg')" alt="{{ __('Logo General Conference') }}">
  </a>

  @if (has_nav_menu('primary_navigation'))
    <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
    </nav>
  @endif
</header>
