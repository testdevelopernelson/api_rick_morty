@extends('layouts.master')

@section('content')
     @include('_partials.banner_text')
   <div class="cont_ly1">
     <div class="container_sd">

          <div class="cont_mdr">
               {!! $section->contents[1]->text_1 !!}
          </div>
          @if(!empty($section->contents[1]->video))
               <div class="cont_mdr">
                    <div class="cont_mdr_ifrm">
                         <iframe  src="https://www.youtube.com/embed/{{ $section->contents[1]->video }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
               </div>
          @endif         

     </div>
</div>  

@endsection