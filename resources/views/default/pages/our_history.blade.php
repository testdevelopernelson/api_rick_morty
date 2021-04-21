@extends('layouts.master')

@section('content')

     @include('_partials.banner', array('class' => ''))

     <div class="bl_emprs">
      <div class="container_sd">
        <div class="emprs_lks">
          <a href="{{ route('our_company') }}">{{ __('menu.our_company') }}<img src="{{ asset('img/icons/icn_wrrl.svg') }}" alt=""
          /></a>
          <a class="active" href="{{ route('our_history') }}">{{ __('menu.our_history') }}</a>
        </div>

        @if (!empty($section->contents[1]->video))
            <div class="emprs_vid">
              <iframe
                src="https://www.youtube.com/embed/{{ $section->contents[1]->video }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
              ></iframe>
            </div>
        @endif       

        <div class="emprs_txu">
          {!! $section->contents[2]->text_1 !!}
        </div>
      </div>
    </div>
    

@endsection
