@extends('layouts.master')

@section('content')

     @include('_partials.banner', array('class' => ''))

     <div class="bl_emprs">
          <div class="container_sd">
             <div class="emprs_lks">
               <a class="active" href="{{ route('our_company') }}">{{ __('menu.our_company') }}</a>
               <a href="{{ route('our_history') }}"
                 >{{ __('menu.our_history') }} <img src="{{ asset('img/icons/icn_wrrl.svg') }}" alt="" />
               </a>
             </div>
             <div class="emprs_txu">
              {!! $section->contents[1]->text_1 !!}
             </div>
          </div>
          <div class="emprs_blu">
              {!! $section->contents[2]->text_1 !!}
             <div class="emprs_blu_itm">
               @foreach ($corporate_values as $item)
                    <div class="emprs_blu_cu">
                      <div class="emprs_blu_imgs">
                        <img src="{{ asset('uploads/' . $item->icon) }}" alt="" />
                      </div>
                      <h3>{{ $item->title }}</h3>
                    </div>
               @endforeach          
             </div>
          </div>
    </div>

    <div class="bl_emprs4">
      <div class="container_sd">
        <div class="bl_emprscld">
          <div class="bl_emprscld_imgi">
            <img src="{{ asset('uploads/' . $section->contents[3]->image_1) }}" alt="" />
          </div>
          <div class="bl_emprscld_txtx">
            {!! $section->contents[3]->text_1 !!}
          </div>
        </div>
        <div class="bl_emprscld">
          <div class="bl_emprscld_imgi">
            <img src="{{ asset('uploads/' . $section->contents[4]->image_1) }}" alt="" />
          </div>
          <div class="bl_emprscld_txtx">
             {!! $section->contents[4]->text_1 !!}
          </div>
        </div>
      </div>
    </div>
    

@endsection
