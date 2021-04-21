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
    
    <div class="bloq_pltp">
        <div class="container_sd">
          <h2>{{ $content->title }}</h2>

          {!! $content->text !!}
        </div>
    </div>
    

@endsection
