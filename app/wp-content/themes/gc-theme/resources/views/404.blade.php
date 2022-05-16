@extends('layouts.app')

@section('content')
  <div class="flex min-h-screen">
    <div class="w-full md:w-[58.5%] relative flex justify-center items-center flex-col grow shrink-0 px-4 pt-36 md:pt-[92px]">
      <img
        class="w-full h-full absolute top-0 left-0 object-cover -z-10"
        src="@asset('images/page-header.jpg')"
        alt="@translate('Imagem de fundo')"
      >

      <img class="h-14 md:h-14 mb-[72px]" src="@asset('images/page-header-logo.png')" alt="@translate('Uma igreja em movimento')">

      <h2 class="text-white text-2xl font-bold">Erro 404</h2>
      @dump(wp_get_theme())
      @dump(get_locale())
      @dump($textDomain)

      <h1 class="text-center text-primary text-2xl md:text-page-title">
        <b>@translate('Me desculpe!')</b><br>
        @translate('Conteúdo não encontrado! :&#40;')
      </h1>

      <p class="text-white text-base mt-4 text-center max-w-[384px]">@translate('O conteúdo que você está procurando não existe e não foi encontrado.')</p>

      <a class="btn-primary py-4 px-6 text-base rounded-full mt-6" href="{{ get_home_url() }}">@translate('Voltar para o início')</a>

      <img class="h-10 mt-20" src="@asset('images/logo-white.svg')" alt="@translate('Logo Igreja Adventista')">
    </div>

    <div class="hidden md:flex grow items-center">
      <img class="w-full" src="@asset('images/404.png')" alt="@translate('404')">
    </div>
  </div>
@endsection
