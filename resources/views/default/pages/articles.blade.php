@extends('layouts.master')

@section('content')

  @include('_partials.banner', array('class' => 'w_bnn_1'))

  <div class="blq_nvd">
      <div class="container_sd" id="load-records">
          @include('_partials.articles')
          <section class="gif-loading">
                <div class="loading"></div>
          </section>
      </div>
  </div>
@endsection

@push('js')

<script type="text/javascript">

var continueLoad = true;
var moreContent = true;
var page = 1;
var url = '{{url()->current()}}';
$( document ).ready(function() {
    $(window).scroll(function(){
        if(($(window).scrollTop() + $(window).height()) * 1.5 >= $(document).height() && continueLoad && moreContent) {
          loadMoreProducts();
        }
    });


    function loadMoreProducts(){

        continueLoad = false;
        page++;
        $.ajax({
                url : url,
                type : 'GET',
                dataType : 'json',
                data : {page : page},
                beforeSend:  function(){
                  $('.loading').fadeIn();
                },
                success : function(response){
                    $('.loading').fadeOut();
                    setTimeout(function() {$('#load-records').append(response.content);}, 1000);
                    
                    if(!response.more_content){
                        moreContent = false;
                    }
                },
                complete : function(){ 
                   continueLoad = true;
                }
        });
    }
});



</script>

@endpush