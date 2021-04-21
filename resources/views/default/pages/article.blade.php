@extends('layouts.master')

@section('metas')

<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $article->title }}">
<meta property="og:description" content="{{ $article->text_intro }}">
<meta property="og:image" content="{{ asset('uploads/'.$article->image_intro) }}">
@stop

@section('content')
  @if (empty($article->image_single))
    @include('_partials.banner',array('class' => 'w_bnn_2'))
  @else
    <div class="w_bnn w_bnn_2">
       <img src="{{ asset('uploads/' . $article->image_single) }}" alt="{{ $article->alt }}" title="{{ $article->tit }}" />

      <div class="container_sd">
        <div class="bloq_mig">
          @include('_partials.breadcrumb')
        </div>
        <div class="w_bnn_tit">
           @if (!empty($article->category))
                <span>{{ $article->category }}</span>
            @endif 
         {!! $article->title_banner !!}
          <p>{{ __('titles.published') }} {{ $article->date->format('d') . ' de ' . $meses[$article->date->format('n') - 1] . ' de ' . $article->date->format('Y') }}</p>
        </div>
      </div>
    </div>
  @endif

  <div class="bl_nvampo">
      <div class="container_sd">
        <h2>{{ $article->title }}</h2>
        <div class="bl_nvampo_cn">
         {!! $article->text_single !!}
        </div>
        <div class="bl_nvampo_rg">
          @if (!empty($article->appoinment))
              <div class="bl_nvampo_rgp">
                {!! $article->appoinment !!}
              </div>
          @endif
         
          <div class="bl_nvampo_rglst">
            <h4>{{ __('titles.share') }}</h4>
            <a class="cursor box_sclh-itm btn_share_facebook" data-url="{{ url()->current() }}">
              <img src="{{ asset('img/icons/icn_face.svg') }}" alt="" />
            </a>
            <a class="cursor box_sclh-itm btn_share_twitter" data-url="{{ url()->current() }}">
              <img src="{{ asset('img/icons/icn_twt.svg') }}" alt="" />
            </a>
            <a class="cursor box_sclh-itm btn_share_linkedin" data-url="{{ url()->current() }}">
              <img src="{{ asset('img/icons/icn_lnkdi.svg') }}" alt="" />
            </a>
            <a class="cursor box_sclh-itm btn_share_whatsapp" data-url="{{ url()->current() }}">
              <img src="{{ asset('img/icons/icn_wp.svg') }}" alt="" />
            </a>
          </div>
        </div>
      </div>
    </div>  
          
@endsection


