 @foreach ($articles as $item)
    <div class="blq_nvd_cu">
          <div class="blq_nvd_cu-img cursor" onclick="window.location.href=('{{ route('article', $item->slug) }}')">
            @if (!empty($item->category))
                <span>{{ $item->category }}</span>
            @endif            
            <img src="{{ asset('uploads/' . $item->image_intro) }}" alt="{{ $item->alt }}" title="{{ $item->tit }}" />
          </div>
          <div class="blq_nvd_cu-txt">
            <h3>{{  $item->title }}</h3>
            <p>
              {{  $item->text_intro }}
            </p>
            <a href="{{ route('article', $item->slug) }}">{{ __('links.read_news') }}</a>
          </div>
    </div>
@endforeach  