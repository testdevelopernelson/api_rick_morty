@extends('layouts.master')

@section('content')
	
     @include('_partials.banner',array('class' => ''))
     
      <div class="bl_responsb">
      <div class="container_sd">
        <div class="bl_responsb_rg">
          <h3>{{ __('menu.responsability') }}</h3>
          @foreach ($responsabilities as $item)
               <a class="{{ $record->id == $item->id ? 'active' : '' }}" href="{{ route('responsability', $item->slug) }}">{{ $item->title }}</a>
          @endforeach
        </div>
        <div class="bl_responsb_cn">
          {!! $record->text !!}
        </div>
      </div>
    </div>

@endsection

