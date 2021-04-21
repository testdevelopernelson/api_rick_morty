@extends('layouts.master')

@section('content')
  
   <!-- #region BLQ PRODUCTOS -->
    <div class="bq_prd_o">
      <div class="container_sd">
        <!-- #region bloqe izq -->
        <div class="bq_prd_ol">
          <div class="btn_op_olrc">X</div>
          <div class="bq_prd_olmw">
             <div class="bq_prd_olm">
              <h2>Para la Oficina</h2>              
              <h3>Uso</h3>
              <ul class="olm_itmlul">
                <li><a href="#">Cartoprint</a></li>
                <li><a href="#">CopyPac</a></li>
                <li><a href="#">Earth Pact</a></li>
                <li><a href="#">Icopel</a></li>
                <li><a href="#">Jean Book</a></li>
                <li><a href="#">Maped</a></li>
                <li><a href="#">Nhitan</a></li>
                <li><a href="#">Panamericana</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
              </ul>
              <div class="olm_btn">Ver todos</div>
            </div>
            <div class="bq_prd_olm">
              <!-- <h2>Para El Hogar</h2> -->
              <h3>Categoría</h3>
              <ul class="olm_itmlul">
                <li><a href="#">Cartoprint</a></li>
                <li><a href="#">CopyPac</a></li>
                <li><a href="#">Earth Pact</a></li>
                <li><a href="#">Icopel</a></li>
                <li><a href="#">Jean Book</a></li>
                <li><a href="#">Maped</a></li>
                <li><a href="#">Nhitan</a></li>
                <li><a href="#">Panamericana</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
              </ul>
              <div class="olm_btn">Ver todos</div>
            </div>

            <div class="bq_prd_olm">
              <!-- <h2>Para la Oficina</h2> -->
              <h3>Subcategoría</h3>
              <ul class="olm_itmlul">
                <li><a href="#">Cartoprint</a></li>
                <li><a href="#">CopyPac</a></li>
                <li><a href="#">Earth Pact</a></li>
                <li><a href="#">Icopel</a></li>
                <li><a href="#">Jean Book</a></li>
                <li><a href="#">Maped</a></li>
                <li><a href="#">Nhitan</a></li>
                <li><a href="#">Panamericana</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
              </ul>
              <div class="olm_btn">Ver todos</div>
            </div>
            
            <div class="bq_prd_olm">
              <h3>Línea</h3>
              <ul class="olm_itmlul">
                <li><a href="#">Cartoprint</a></li>
                <li><a href="#">CopyPac</a></li>
                <li><a href="#">Earth Pact</a></li>
                <li><a href="#">Icopel</a></li>
                <li><a href="#">Jean Book</a></li>
                <li><a href="#">Maped</a></li>
                <li><a href="#">Nhitan</a></li>
                <li><a href="#">Panamericana</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
              </ul>
              <div class="olm_btn">Ver todos</div>
            </div> 

            <div class="bq_prd_olm">
              <!-- <h2>Para la Oficina</h2> -->
              <h3>Marca</h3>
              <ul class="olm_itmlul">
                <li><a href="#">Cartoprint</a></li>
                <li><a href="#">CopyPac</a></li>
                <li><a href="#">Earth Pact</a></li>
                <li><a href="#">Icopel</a></li>
                <li><a href="#">Jean Book</a></li>
                <li><a href="#">Maped</a></li>
                <li><a href="#">Nhitan</a></li>
                <li><a href="#">Panamericana</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
              </ul>
              <div class="olm_btn">Ver todos</div>
            </div>
          </div>
        </div>
        <!-- #endregion -->

        <!-- #region bloque Central -->
        <div class="bq_prd_ocnt">
          <div class="bq_prd_om">
            @include('_partials.breadcrumb')
            <div class="bq_prd_rdnar">
              <div class="btn_op_olr"></div>
              <select name="" id="">
                <option value="">Oredenar</option>
                <option value="">Menor precio</option>
                <option value="">Mayor precio</option>
                <option value="">Más vendido</option>
              </select>
            </div>
            <div class="blq_tit_W">
              <div class="blq_tit">
                <div class="blq_tit_h">
                  <img src="{{ asset('img/icons/icn_papeleria.svg') }}" alt="" />
                  <h2>{{ $record_linea->name }}</h2>
                </div>
              </div>
            </div>
          </div>

          <div class="bq_prd_oc">
          	@foreach ($products as $product)
          		@include('shop._partials.product')
          	@endforeach
          </div>
        </div>
        <!-- #endregion -->
      </div>
    </div>
    <!-- #endregion -->
     

@endsection
