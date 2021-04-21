@extends('layouts.master')

@section('content')

     @include('_partials.banner', array('class' => ''))
     
    <div class="blq_enlcint">
      <div class="container_sd">
          @foreach ($questions as $item)
              <div class="blq_enlcint_acd">
                    <button class="accd_btn">{{ $item->title }}</button>
                    <div class="accd_content">
                      {!! $item->text !!}
                    </div>
               </div>
          @endforeach
      </div>
    </div>

@endsection
