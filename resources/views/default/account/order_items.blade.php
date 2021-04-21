@extends('layouts.master')

@section('content')
    <div class="bl_mcnta_w bl_mcnta_wex" v-cloak>
      @include('account._partials.logout')
      <order-items inline-template :order="{{ json_encode($order) }}" :user="{{ json_encode($user) }}" :devolutions="{{ json_encode($devolutions) }}" variable="global">
       	<section  v-cloak>
       	 	<router-view></router-view>
        </section>  
      </order-items>
      <div id="element-back-account" class="bl_micnta3" style="display: none;">
          <div class="container_sd">
            <a href="{{ route('account.home') }}" class="lst_pedidos_lkn">Volver a mi cuenta</a>
          </div>
      </div>
    </div>
@endsection

@push('js')
  <script>
      setTimeout(function(){ $('#element-back-account').fadeIn() }, 1000);
  </script>
@endpush