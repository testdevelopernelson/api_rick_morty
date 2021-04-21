<div class="bnn_ppl_wrp">
     <div class="bnn_ppl" style="background-image: url('{{ asset('uploads/' . $section->contents[0]->image_1) }}');" >
          <div class="container_sd">
               <div class="mgs_p">
                    <a href="{{ url('/') }}">{{ __('menu.home') }}</a>
                    @foreach($breadcrumb as $key => $item)
                         @if($item['url'])
                              <a href="{{ $item['url'] }}">{{ $item['title']}}</a>
                         @else
                              <a>{{ $item['title']}}</a>
                         @endif
                    @endforeach
               </div>
               <div class="bnn_ppl_txt">
                    {!! $section->contents[0]->text_1 !!}
               </div>
          </div>
     </div>
</div>