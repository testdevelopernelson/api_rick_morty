<div class="bloq_mig">
  <a href="{{ url('/') }}">{{ __('menu.home') }}</a>
 @foreach($breadcrumb as $key => $item)
 			@if (isset($item['url']))
			 	@if($item['url'])
            <a href="{{ $item['url'] }}">{{ $item['title']}}</a>
       	@else
          	<a>{{ $item['title']}}</a>
       	@endif
 			@endif      
  @endforeach
</div>