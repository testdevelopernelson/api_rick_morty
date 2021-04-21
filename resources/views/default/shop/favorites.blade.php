@extends('layouts.master')

@section('metas')

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
  <div class="blq_tit_W">
      <div class="container_sd">
        <div class="blq_tit">
          <div class="blq_tit_h">
            <img src="{{ asset('img/icons/icn_acceso_cliente.svg') }}" alt="" />
            <h2>Mis favoritos</h2>
          </div>
        </div>
      </div>
    </div>

    <!-- #region BLQ PRODUCTOS -->
    <div class="bq_prd_w">
      <div class="container_sd">
          @foreach ($products as $product)
            @include('shop._partials.product')
          @endforeach
      </div>
    </div>
    <!-- #endregion -->
          
@endsection


