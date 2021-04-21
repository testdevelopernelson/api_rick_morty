<div class="modal-backdrop fade in"></div>
<section id="myModalCatalog" class="myModalPdf modal fade form-box modal-visor" role="dialog">	
	<section class="visor-pdf">
          <button type="button" class="close" data-dismiss="modal" id="closeModal">&times;</button>
          <div id="embed-pdf">        
               
          </div>
      </section>	
</section>

@push('js')
    <script>
        $('#closeModal').click(function (e) { 
            $('.modal-backdrop.fade.in').fadeOut();
            $('.modal').fadeOut();             
        });

        $('.openModal').click(function (e) { 
             let url = $(this).data('url');
             $('#embed-pdf').empty();
             $('#embed-pdf').append('<embed src="'+url+'" width="500" height="375">');

            $('.modal-backdrop.fade.in').fadeIn();
            $('.modal').fadeIn();             
        });
    </script>

@endpush