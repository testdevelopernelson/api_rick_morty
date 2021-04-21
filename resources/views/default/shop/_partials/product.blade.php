@php
  $image_main = !empty($product->image_main) ? $product->image_main : 'nodisponible.jpg'
@endphp
<div class="pd_cug">
    <div class="pd_cu">
      <add-favorite inline-template>
        <div>
          @if (in_array($product->codigo, $favorites))
            <div v-if="!add_favorite" class="pd_cu-lke" style="background: url('{{ asset('img/icons/icn_lke.svg') }}') center center no-repeat" v-on:click.prevent="addToFavorite1({{ json_encode($product->codigo) }})"></div>
            <div v-else class="pd_cu-lke" style="background: url('{{ asset('img/icons/icon_p.svg') }}') center center no-repeat" v-on:click.prevent="removeToFavorite1({{ json_encode($product->codigo) }})"></div>
          @else
            <div v-if="add_favorite" class="pd_cu-lke" style="background: url('{{ asset('img/icons/icn_lke.svg') }}') center center no-repeat"  v-on:click.prevent="addToFavorite({{ json_encode($product->codigo) }})"></div>
            <div v-else class="pd_cu-lke" style="background: url('{{ asset('img/icons/icon_p.svg') }}') center center no-repeat"  v-on:click.prevent="removeToFavorite({{ json_encode($product->codigo) }})"></div>
          @endif
        </div>
      </add-favorite>
      <div class="pd_cu-img">
        <img src="{{ asset('img/products/img/' . $image_main) }}" alt="" />
      </div>
      <div class="pd_cu-txt">
        <h3>{{ $product->marca }}</h3>
        <h2>{{ $product->nombre }}</h2>
        <div class="pd_cu-prc">{{ $product->price }}</div>
        <a href="#" class="pd_cu-cmp">Comprar</a>
      </div>
    </div>              
</div>