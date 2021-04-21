@extends('layouts.master')

@section('metas')

<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $content->title }}">
<meta property="og:description" content="{{ $content->meta_description }}">
<meta property="og:image" content="{{asset('uploads/'.config('settings.shop_logo')) }}">
@stop

@section('content')  

  <div class="bq_prd_o">
      <div class="container_sd">
        <div class="bq_prd_ocnt">
          <div class="bq_prd_om">
            @include('_partials.breadcrumb')
          </div>
        </div>
      </div>
  </div> 
  <div class="bq_prd_o">
      <div class="container_sd">
        <section class="visor-pdf">
        <h2>{{ $content->title }}</h2>
            <div id="embed-pdf">          
            </div>
        </section>
      </div>
  </div>
          
@endsection

@push('js')
    <script>
        let url_pdf = '{{ $content->url_pdf }}';
        let url;             
        if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) {
           url = "https://drive.google.com/viewerng/viewer?embedded=true&url="+ url_pdf;
        } else {
           url = url_pdf;
        } 
        $('#embed-pdf').empty();
        $('#embed-pdf').append('<embed src="'+url+'" width="100%" height="100%">'); 
    </script>

@endpush


