@extends('layouts.master')

@section('content')

     @include('_partials.banner')
     <div class="cont_ly1  b_blgint_w">
          <div class="container_sd content-quick-access cont_bcenter">
               <ul>
                    @foreach($collection as $key => $item)
                    @php
                        $text = substr(strip_tags($item['text']), 0, 150)
                    @endphp
                    <li>{{ $item['title'] }} </li>
                    <p>{!! $item['text'] != null  ? $text : '' !!} <a href="{{ $item['url'] }}">Mas...</a></p>
                    @endforeach
               </ul>
          </div>
     </div>
@endsection
