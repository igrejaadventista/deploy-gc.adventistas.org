@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')

    @if(has_post_thumbnail())
      <div class="aspect-thumbnail max-h-[572px] w-full">
        <img class="w-full h-full object-cover" src="@thumbnail('full', false)" alt="@title">
      </div>
    @endif

    @includeFirst(['partials.content-page', 'partials.content'])
  @endwhile
@endsection
