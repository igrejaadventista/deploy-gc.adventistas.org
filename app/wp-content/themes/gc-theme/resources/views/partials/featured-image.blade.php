@if(has_post_thumbnail())
  <div class="aspect-thumbnail max-h-[572px] w-full">
    <img class="w-full h-full object-cover" src="@thumbnail('full', false)" alt="@title">
  </div>
@endif
