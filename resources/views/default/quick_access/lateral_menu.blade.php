<div class="cont_ly1">
     <div class="container_sd">
          <div class="cont_bleft_w">
               <div class="cont_bleft">
                    @foreach($record->menus as $key => $item)
                    @if($menu == '')
                         <a href="{{ route('quick_access.menu', [$record->slug, $item->slug]) }}" class="{{ $key == 0 ? 'active' : '' }}">{{ $item->title }} </a>
                    @else
                         <a href="{{ route('quick_access.menu', [$record->slug, $item->slug]) }}" class="{{ $item->id == $menu->id ? 'active' : '' }}">{{ $item->title }} </a>
                    @endif
                        
                    @endforeach
                    @if(!empty($record->image) || !empty($record->text))
                         <div class="cont_bleft_sc">
                              <div class="cont_bleft_img" style="background-image: url('{{ asset('uploads/' . $record->image)}}');" >
                              </div>
                              <div class="cont_bleft_txt">
                                   {!! $record->text !!}
                              </div>
                         </div>
                    @endif
               </div>
               <div class="cont_bleft_btn"><div class="icon nav-icon-6"><span></span><span></span><span></span></div></div>
          </div>

          <div class="cont_bcenter cont_bcenter_bne">
               @if($menu != '' && $menu->has_tab)
                    <div class="sbm_mn">
                         @foreach($menu->tabs as $key => $item)
                              @if($tab == null)
                                   <a href="{{ route('quick_access.tab', [$record->slug, $menu->slug, $item->slug]) }}" class="{{ $key == 0 ? 'active' : '' }}">{{ $item->title }}</a>
                              @else
                                   <a href="{{ route('quick_access.tab', [$record->slug, $menu->slug, $item->slug]) }}" class="{{ $item->id == $tab->id ? 'active' : '' }}">{{ $item->title }}</a>
                              @endif                             
                         @endforeach
                    </div>
               @endif                    
               @include('_partials.contents')
          </div>
     </div>
</div>

