$(document).ready(function () {
/*=================================*/
/*Recarga al girar dispositivo*/
window.onorientationchange = function() {
	window.location.reload();
}
/*=================================*/
$('h1, h2').each(function() {
	var $this = jQuery(this);
	if ($this.html().replace(/\s|&nbsp;/g, '').length == 0) {
		$this.remove();
	}
});

/*=================================*/
$(".formulario .privacidad_check").click(function() {
	if ($(this).is(':checked')) {
		$('.formulario .boton').removeAttr("disabled");
	} else {
		$('.formulario .boton').attr("disabled", "true");
	}
});
/*=================================*/
$(document).scroll(function() {
	var y = $(this).scrollTop();
	if (y > 120) {
		$('#subir').fadeIn();
	} else {
		$('#subir').fadeOut();
	}
});
$('#subir').on('click', function() {
	$('html, body').animate({ scrollTop: 0 }, 'fast');
	return false;
});
/*=================================*/
$(".pagina.v2").hide();
$(".pagina.v2:first").show();
$(".tabs.v2 li:first a").addClass("activo");
$(".tabs.v2 li a").bind('click', function(){
	var linkIndex = $(".tabs.v2 li a").index(this);
	$(".tabs.v2 li a").removeClass("activo");
	$(".pagina.v2:visible").hide();
	$(".pagina.v2:eq("+linkIndex+")").show();
	$(this).addClass("activo");
	return false;
});
/*=================================*/
$(".pagina.v1").hide();
$(".pagina.v1:first").show();
$(".tabs.v1 li:first a").addClass("activo");
$(".tabs.v1 li a").bind('click', function(){
	var linkIndex = $(".tabs.v1 li a").index(this);
	$(".tabs.v1 li a").removeClass("activo");
	$(".pagina.v1:visible").hide();
	$(".pagina.v1:eq("+linkIndex+")").show();
	$(this).addClass("activo");
	return false;
});
/*=================================*/
$('.bajar').on('click', function () {
	$('html, body').animate({ scrollTop: $('#home_nosotros').offset().top }, 'normal');
	return false;
});
/*=================================*/
$(".pedido a.mas").click(function(e) {
	e.preventDefault();
	if($(this).hasClass("activo")){
		$(this).text("+");
		$(this).removeClass("activo");
		$(this).parent().parent().find(".invisible").hide("fast");
	}
	else{
		$(this).text("-");
		$(this).addClass("activo");
		$(this).parent().parent().find(".invisible").show("fast");
	}
	return false;
});
/*=================================*/
$("#btn_menu_categorias").click(function(e){
	e.preventDefault();
	if($(this).hasClass("activo")){
		$(this).removeClass("activo");
		$("#menu_categorias").hide("fast");
		$(".row").removeClass("blured");
	}
	else{
		$("a.primary.parent").removeClass("activo");
		$(".menu_desplegable").hide("fast");
		$(this).addClass("activo");
		$("#menu_categorias, #menu_categorias .menu").show("fast");
		$(".row").addClass("blured");
	}
	return false;
});
/*=================================*/
$("#btn_menu_mayoristas").click(function(e){
	e.preventDefault();
	if($(this).hasClass("activo")){
		$(this).removeClass("activo");
		$("#menu_mayoristas").hide("fast");
		$(".row").removeClass("blured");
	}
	else{
		$("a.primary.parent").removeClass("activo");
		$(".menu_desplegable").hide("fast");
		$(this).addClass("activo");
		$("#menu_mayoristas, #menu_mayoristas .menu").show("fast");
		$(".row").addClass("blured");
	}
	return false;
});
/*=================================*/
$("#btn_menu_cuenta").click(function(e){
	e.preventDefault();
	if($(this).hasClass("activo")){
		$(this).removeClass("activo");
		$("#menu_cuenta").hide("fast");
		$(".row").removeClass("blured");
	}
	else{
		$("a.primary.parent").removeClass("activo");
		$(".menu_desplegable").hide("fast");
		$(this).addClass("activo");
		$("#menu_cuenta, #menu_cuenta .menu").show("fast");
		$(".row").addClass("blured");
	}
	return false;
});
/*=================================*/

/*=================================*/
$("a.categoria").click(function(e){
	e.preventDefault();
	if($(this).hasClass("activo")){
		$(this).removeClass("activo");
		$(this).parent().next(".Menu_Container").removeClass("visible");
	}
	else{
		$("a.categoria").removeClass("activo");
		$(".Menu_Container").removeClass("visible");
		$(this).addClass("activo");
		$(this).parent().next(".Menu_Container").addClass("visible");
	}
	return false;
});

// $("a.categoria").hover(function(e){
// 	e.preventDefault();
// 	$("a.categoria").removeClass("activo");
// 		$(".Menu_Container").removeClass("visible");
// 		$(this).addClass("activo");
// 		$(this).parent().next(".Menu_Container").addClass("visible");
// 	return false;
// });

 $(document).on("click",function(e) {
	var container = $(".menu");                            
  if (!container.is(e.target) && container.has(e.target).length === 0) { 
 		$('.btn_menu_categorias').removeClass("activo");
		$("#menu_categorias").hide("fast");
		$(".row").removeClass("blured");  
		$('.primary.parent').removeClass('activo')          
  }
});
/*=================================*/
$(".contacto .acordeon li:first .row").show("fast").addClass("active");
$(".contacto .acordeon li:first .ampliar").addClass("activa");

$(".acordeon .ampliar").click(function() {
	if ($(this).hasClass('activa')) {
		$(this).next(".row").hide("fast").addClass("active");
		$(this).removeClass("activa");
	} else {
		$(".acordeon .row").hide("fast").removeClass("active");
		$(".acordeon .ampliar").removeClass("activa");
		$(this).next(".row").show("fast").addClass("active");
		$(this).addClass("activa");
	}
	return false;
});
/*=================================*/
$(document).scroll(function(){
    var y = $(this).scrollTop();
    if (y > 100) {
		$("#scrolldown").fadeOut();
    } else {
		$("#scrolldown").fadeIn();
	}
	if (y > 90) {
		$("#header").addClass("estatico");
    } else {
		$("#header").removeClass("estatico");
    }
    if (y > 200) {
		$("#header").addClass("fijo");
    } else {
		$("#header").removeClass("fijo");
	}
	if (y > 330) {
		$(".supertitle .estatico").addClass("listo");
    } else {
		$(".supertitle .estatico").removeClass("listo");
    }
	if (y > 400) {
		$(".supertitle .estatico").addClass("fijo");
    } else {
		$(".supertitle .estatico").removeClass("fijo");
    }
});
/*=================================*/
$('.buscar').on('click', function(){
	$('#header_busqueda').toggle("fast");
	$(this).toggleClass("active");
	return false;
});
/*=================================*/
$(".play").click(function(e) {
	e.preventDefault();
	quita_scroll_del_body();
	$(".opacity").show();
	$(".contenedor_modal").show();
	$(".modal").show();
	$(".close_modal").show();
	return false;
});
	/*--------------*/
function quita_scroll_del_body() {
	$("body").addClass("sin_scroll");
}
function pone_scroll_del_body() {
	$("body").removeClass("sin_scroll");
}
	/*----------Modal-----------*/

/*=================================*/
if($("body").hasClass("home")){
	// quita_scroll_del_body();
	// $(".opacity").show();
	// $(".contenedor_modal").show();
	// $(".modal").show();
	// $(".close_modal").show();
}
/*=================================*/
$(".desplegable_rspnsv").hide();
//$(".desplegable_rspnsv:first").show();
$(".primarias_rspnsv a").bind('click', function(){
	var linkIndex = $(".primarias_rspnsv li a").index(this);
	$(".primarias_rspnsv li a").removeClass("activo");
	$(".desplegable_rspnsv:visible").hide();
	$(".desplegable_rspnsv:eq("+linkIndex+")").show();
	$(this).addClass("activo");
	return false;
});
/*=================================*/

$('.close_menu_resp').on('click', function () {
	reset_all();
});

$(".submenu_rspnsv").hide();

$(".desplegable_rspnsv li a.categoria").bind('click', function(){
	var linkIndex = $(".desplegable_rspnsv li a.categoria").index(this);
	$(".desplegable_rspnsv li a.categoria").removeClass("activo");
	$(".submenu_rspnsv:visible").hide();
	$(".submenu_rspnsv:eq("+linkIndex+")").show();
	$(this).addClass("activo");

	var sub = $(".submenu_rspnsv:eq("+linkIndex+")").height();
	var win = $(window).height();

	if (sub > win ) {		
		$(".submenu_rspnsv:eq("+linkIndex+")").addClass('pone_scroll');
	}
	else{
		$(".submenu_rspnsv:eq("+linkIndex+")").removeClass('pone_scroll');
	}

	return false;
});
/*=================================*/
/*var width = jQuery(window).width();
if (width > 980) {
	$(".supertitle a.filtro").hide("fast");
	$(document).scroll(function(){
		var y = $(this).scrollTop();
		if (y < 400) {
			$(".filtros").removeClass("fijos");
			$(".supertitle a.filtro").hide("fast");
		} else {
			$(".filtros").addClass("fijos");
			$(".supertitle a.filtro").show("fast");
		}
	});
}*/



var width = jQuery(window).width();
/*if (width > 980) {
	
		$('a.filtro').on('click', function () {
			$(".filtros").toggleClass("invisibles");
			quita_scroll_del_body();
			$(this).addClass("active");
			return false;
		});
	
		$(document).scroll(function(){
			var y = $(this).scrollTop();
			if (y > 400) {
				$(".filtros").addClass("invisibles");
			} else {
				$(".filtros").removeClass("invisibles");
			}
		});
	
}*/
if (width <= 979) {

		$(".filtros").addClass("invisibles");
		$(".filtros").addClass("fijos");
		$(".filtros").addClass("fijos_rspnsv");
	
		$('a.filtro').on('click', function () {
			$(".filtros").toggleClass("invisibles");
			quita_scroll_del_body();
			$(this).addClass("active");
			return false;
		});
}
/*=================================*/
$('#pull').on('click', function () {
	$("#menu_rspnsv").show("fast");
	quita_scroll_del_body();
	$(this).toggleClass("active");
	return false;
});

/*=================================*/
$("body").click(function() {
	reset_all();
});

var width = $(window).width();
if (width > 980) {
	$("a.filtro").removeClass("fijos_rspnsv");
}
if (width <= 979) {
	$("body").click(function() {
		$(".filtros").addClass("invisibles");
	});

}
	$(".opacity").hide();
	$(".contenedor_modal").hide();
	$(".modal").hide();
	$('iframe').attr('src', $('iframe').attr('src'));
$(".cerrar").click(function() {
	pone_scroll_del_body();
	$(".opacity").hide();
	$(".contenedor_modal").hide();
	$(".modal").hide();
	$('iframe').attr('src', $('iframe').attr('src'));
	return false;
});
$("#menu_rspnsv, .menu_desplegable .menu, .filtros, .modal_main").click(function(e) {
    e.stopPropagation();
});




/*=================================*/

$(".primarias_rspnsv li a").click(function() {
	$(".primarias_rspnsv").addClass("oculta");
	$(".desplegable_rspnsv").addClass("muestra");
});
$(".volver_1").click(function() {
	$(".primarias_rspnsv").removeClass("oculta");
	$(".desplegable_rspnsv").removeClass("muestra");
});
/*=================================*/
$(".desplegable_rspnsv li a.categoria").click(function() {
	$(".desplegable_rspnsv").addClass("oculta");
	$(".submenu_rspnsv").addClass("muestra");
});
$(".volver_2").click(function() {
	$(".desplegable_rspnsv").removeClass("oculta");
	$(".submenu_rspnsv").removeClass("muestra");
	$(".submenu_rspnsv").removeClass("pone_scroll");
});
/*=================================*/
$('.filtros ul').find('li:gt(2)').hide();
$('p.todos').each(function(index){
	$(this).on("click", function(){
		if($(this).hasClass("activo")){
			$(this).prev('ul').find("li:gt(2)").hide();
			$(this).find('a').html("Ver todos");
			$(this).removeClass("activo");
		}else{
			$(this).prev('ul').find("li").show();
			$(this).find('a').html("Ver menos");
			$(this).addClass("activo");
		}
	});
});

/*=================================*/

$('body').on('click', '.order_mood button', function(event){
	event.preventDefault();
	$('.order_mood button').removeClass('active');
	$(this).addClass('active');
})
	function reset_all(){
		$("#pull").removeClass("active");
		$("#menu_rspnsv").hide("fast");
		$(".menu_desplegable").hide("fast");
		$(".menu_desplegable .menu").hide("fast");
		$(".row").removeClass("blured");
		$('body').removeClass("active");
		$("a.primary.parent").removeClass("activo");
		$(".filtros").removeClass("fijos");
		$(".filtros").removeClass("fijos_rspnsv");
		$("a.filtro").removeClass("active");
		$(".primarias_rspnsv").removeClass("oculta");
		$(".desplegable_rspnsv").removeClass("oculta");
		$(".desplegable_rspnsv").removeClass("muestra");
		$(".submenu_rspnsv").removeClass("muestra");
		$(".opacity").hide();
		$(".contenedor_modal").hide();
		$(".modal").hide();
		$('iframe').attr('src', $('iframe').attr('src'));
		pone_scroll_del_body();
	}
});
