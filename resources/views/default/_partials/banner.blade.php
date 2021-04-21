<!--====================== BOF fondo_elipse ====================-->
<div class="row margen categoria" id="fondo_elipse" style="background-image: url('{{ asset('uploads/' . $section->contents[0]->image_1) }}');">
    <div class="cols">
        <div class="tabla">
            <div class="celda">
                {!! $section->contents[0]->text_1 !!}
            </div>
        </div>
    </div>
    <img src="{{ asset('img/mascara_elipse.png') }}" class="mascara">
</div>
<!--====================== EOF fondo_elipse ====================-->