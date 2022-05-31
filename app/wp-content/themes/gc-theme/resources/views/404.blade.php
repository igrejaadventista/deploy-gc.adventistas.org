@extends('layouts.app')

@section('content')
  <div class="flex min-h-screen">
    <div class="w-full md:w-[58.5%] relative flex justify-center items-center flex-col grow shrink-0 px-4 pt-36 md:pt-[92px]">
      <img
        class="w-full h-full absolute top-0 left-0 object-cover -z-10"
        src="@asset('images/page-header.jpg')"
        alt="<?php __('Imagem de fundo',  'gc') ?>"
      >

      <img class="h-14 md:h-14 mb-[72px]" src="{{ \App\translateImage('page-header-logo.png') }}" alt="<?php __('Uma igreja em movimento', 'gc') ?>">

      <h2 class="text-white text-2xl font-bold"><?php __('Erro 404', 'gc') ?></h2>

      <h1 class="text-center text-primary text-2xl md:text-page-title">
        <b><?php __('Me desculpe!', 'gc') ?>
      </b><br>
        <?php __('Conteúdo não encontrado! :', 'gc') ?>
      </h1>

      <p class="text-white text-base mt-4 text-center max-w-[384px]"><?php  __('O conteúdo que você está procurando não existe e não foi encontrado.', 'gc') ?></p>

      <a class="btn-primary py-4 px-6 text-base rounded-full mt-6" href="<?php get_home_url() ?>"><?php __('Voltar para o início', 'gc') ?></a>

      <img class="h-10 mt-20" src="@asset('images/logo-white.svg')" alt="<?php __('Logo Igreja Adventista', 'gc') ?>">
    </div>

    <div class="hidden md:flex grow items-center">
      <img class="w-full" src="@asset('images/404.png')" alt="<?php __('404', 'gc') ?>">
    </div>
  </div>
@endsection
