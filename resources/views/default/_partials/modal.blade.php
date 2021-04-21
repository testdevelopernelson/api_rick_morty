<!--================ MODAL ==========================-->
 <div class="row modal popup">
    <a class="cerrar" href="#"></a>
    <div class="cols modal_main">
        <div class="col col_2">            
            <div class="foto" style="background-image: url({{ asset('uploads') }});">
            </div>
        </div>
        <div class="col col_2">
            <div class="tabla">
                <div class="celda">
                    <p class="centrado minimargen"><img src="{{ asset('img/icons/logo.png') }}"></p>
                    <p class="minimargen">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies mauris a sodales convallis. Mauris ultricies, odio ut commodo congue, sem felis consectetur est, in bibendum ipsum mi vel eros. Nullam ac tristique dolor. Nullam in lectus nisi. Donec feugiat ante sapien, a dictum neque dignissim at. Morbi congue, quam vel suscipit viverra, lacus metus volutpat quam, eu pretium erat leo ut nibh. Maecenas quis magna sed orci convallis lacinia.</p>
                    <div class="row formulario gris">
                        <form>                         
                            <div class="cols">
                                <div class="col col_1">
                                    <h2 class="minimargen">Pre-registro del comercio</h2>
                                    <div class="cols tinymargen">
                                        <div class="col col_2">
                                            <input type="text" name="" class="ico ico_k_edificio" autocomplete="no-complete" placeholder="Nombre del comercio">
                                        </div>
                                        <div class="col col_2">
                                            <select name="" class="ico ico_k_maleta">
                                                <option value="0">Categoría del comercio</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>                                        
                                        </div>
                                    </div>
                                    <div class="cols">
                                        <div class="col col_3_4">
                                            <div class="aviso_privacidad tinymargen">
                                                <p class="etiqueta">
                                                    <input class="privacidad_check" type="checkbox" value="1" checked="checked"><a target="_blank" href="#" onclick="return false;">
                                                        He leído y acepto las Condiciones de tratamiento de datos</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col col_1_4">
                                            <input class="boton azul small" name="" type="submit" value="ENVIAR">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row opacity"></div>
<!--================= MODAL ======================= -->