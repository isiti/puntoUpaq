let swRegistration = null;
let isSubscribed = false;
const applicationServerPublicKey = "BKu8mJK4gLLWxPvw_1IZZqANa7IYQjSWy6azouuMJ49qu4V3ZgU7ejvQpmjRI7VFW3v6lOWHFSN026suPL2LwQo";
var latactual = 0;
var longactual = 0;
var map;
var redMarker;
var current_location;
var viaje_activo=false;
var index_viajes_activos = 0;
var marcador_viaje;
var ruta;
var puntero_buscador;
var direcciones_origen;
var step_fv_to;
var step_firma_to;
var gps_interval;


(function($) {
	"use strict";
	$(document).ready(function(){
		boton_aceptar_direccion();
		actualizar_lista_direcciones();
		getLocation();
		botones_mis_viajes();
		reservar_viaje ();
		if ($("input[name=ubicacion-actual]") != undefined)  cargar_direcciones();
		content_size();
		change_tab();
		h();
		popstate();
		preventscroll();
		notifications();
		signup_ajax();
		login();
		restaurar_mensajes_login();
		forgot();
		forgot_pass();
		popup_config();
		print_name();
		check_reservation();
		comenzar_viaje_prueba();
		choose_name();
		// check_pending_review();
		$(window).resize(function(){
			content_size();
		});

		//Cosas del Mapa
		if (document.getElementById("mapid") != null)
		{
			map = L.map('mapid', {doubleClickZoom: false}).locate({setView: true, maxZoom: 16});
			L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidGVhbWdyZWVuIiwiYSI6ImNqbTZwcmY2ZzAyNGkzcXBhNHdzdWlheHoifQ.8P0ze1MhKd9IKR6sMjeeXA', {
			    attribution: 'Map data &copy; ,<a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
			    maxZoom: 16,
			    minZoom: 14,
			    id: 'mapbox.streets',
			    accessToken: 'pk.eyJ1IjoidGVhbWdyZWVuIiwiYSI6ImNqbTZwcmY2ZzAyNGkzcXBhNHdzdWlheHoifQ.8P0ze1MhKd9IKR6sMjeeXA'
			}).addTo(map);
			map.on('locationfound', function(e){
	          L.marker(e.latlng).addTo(map);
	          current_location = e.latlng;
	        });	
		}
	});
})(jQuery);

//////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES GENERALES
//////////////////////////////////////////////////////////////////////////////////////////

$( function() {
	$.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: '< Ant',
		nextText: 'Sig >',
		currentText: 'Hoy',
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''
		};
		$.datepicker.setDefaults($.datepicker.regional['es']);
    $( ".datepicker" ).datepicker().datepicker("setDate", new Date());
});

$(function () {
	var options = { 
		showMeridian: false
	}; 
	$('.timepicker').timepicker(options);;
});

$(function () {
	$('#back_inicio').click(function() {
		document.getElementById("mySidenav").style.width = "0";
		change_section('home');
	})
});

$(function () {
	$('[data-toggle="popover"]').popover()
});

$("#back_home2").click(function() {
	change_section('home');
});

var nanilab = {
	site: {
		home: 'Punto U',
		reserve: 'Reservar',
		ask_now: 'Pedir Ahora',
		reserved_ok: 'Viaje Reservado',
		matches: 'Mis Partidos',
		notifications: 'Notificaciones',
	},
	status: {
		back: {
			section: ''
		},
		current: {
			section: 'home'
		},
	},
	title: {
		element: $('.title'),
		change: function(string){
			// Change on page
			document.title = string+' - Matchat';
			// Change in bar
			$('.title span').fadeOut(0, function() {
				$(this).text(string).fadeIn(150);
			});
		},
	},
	content: {
		element: $('.content'),
		section: {
			element: function(section){ return $('.show-content[data-section="'+section+'"]'); }
		},
		all: $('.show-content')
	},
	posts: {
		element: $('.content .posts'),
	},
	tabs: {
		element: $('.tabs'),
		items: {
			element: $('.sec-ident'),
			find: function(section){ return $('.sec-ident[data-section="'+section+'"]'); }
		},
	},
	profile: {
		up: {
			element: $('.show-content[data-section="profile"] .up'),
		},
		down: {
			element: $('.show-content[data-section="profile"] .down'),
		}
	},
	activity: {
		last: '',
		actual: 'home',
		register: function(string){
			nanilab.activity.last = nanilab.activity.actual;
			nanilab.activity.actual = string;
		}
	},
	notifications: {
		button: $('.notification-button')
	},
	h: {
		// h for History
		backbutton: $('.backbutton'),
		pressed: false
	}
}

/* Set the width of the side navigation to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

// Main function to chagen sections
function change_section(id){
	nanilab.content.all.hide(0);
	nanilab.content.section.element(id).show(0);

	nanilab.tabs.items.element.removeClass('selected');
	if (parent = has_parent(nanilab.content.section.element(id)))
		nanilab.tabs.items.find(parent).addClass('selected')
	else
		nanilab.tabs.items.find(id).addClass('selected')

	nanilab.title.change(nanilab.site[id]);

	if (id == 'profile'){
		nanilab.content.element.addClass('on-profile')
		nanilab.title.element.addClass('on-profile')
	}
	else if (nanilab.title.element.hasClass('on-profile') || nanilab.content.element.hasClass('on-profile')){
		nanilab.content.element.removeClass('on-profile');
		nanilab.title.element.removeClass('on-profile');
	}

	// Shows backbutton
	if (id != 'home')
		nanilab.h.backbutton.fadeIn(150)
	else
		nanilab.h.backbutton.fadeOut(150)
}

// Back and foward buttons
function popstate(){
	window.onpopstate = function(event){
		try {
			var id = event.state.current.section;
			if (nanilab.status.current.section != id){
				nanilab.status.back.section = { section: nanilab.status.current.section };
				nanilab.status.current.section = id;
				change_section(id);
			}
		}
		catch(error) {
			change_section('home');
			console.log("pop_state");
		}
	};
}

// Main function to push history
function push_history(id){
	if (nanilab.status.current.section != id){
		nanilab.status.back = { section: nanilab.status.current.section };
		nanilab.status.current.section = id;

		history.pushState(nanilab.status, nanilab.site[id], hash(id));
		change_section(id);
	}
}

function content_size(){
	var height = $(window).height()-(nanilab.title.element.outerHeight()+nanilab.tabs.element.outerHeight());
	nanilab.content.element.css({'height' : height+'px'});
}

function change_tab(){
	nanilab.tabs.items.element.click(function(){
		var id = $(this).data('section');
		push_history(id);
	});

	force_change_tab();
	function force_change_tab(){
		$('.content').on('click', '.force-change-tab', function(){
			var id = $(this).data('goto');
			push_history(id);
		});
	}
}

function preventscroll(){
	window.block = false;
	$(window).on('touchstart', function(e){
		if ($(e.target).closest('.tabs').length == 1){
			block = true;
		}
	});
	$(window).on('touchend', function(){
		block = false;
	});
	$(window).on('touchmove', function(e){
		if (block){
			e.preventDefault();
		}
	});
}

function h(){
	// Go back
	nanilab.h.backbutton.click(function(){
		window.history.go(-1);
	});
}

function has_parent(element){
	if (element.data('parent') === undefined)
		return false
	else
		return element.data('parent')
}

function hash(string){
	return '#'+string;
}

function unhash(string){
	return string.substr(1);
}

function notifications(){
	nanilab.notifications.button.click(function(){
		push_history('notifications');
	});
}

/* función nueva para que detecte el cambio cuando el usuario termina de escribir */
(function($){
    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress paste input',function(e){
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too preemptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type=='keyup' && e.keyCode!=8) return;

                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);

function signup_ajax(){
	$("#datos #submit").click(function(event){
		console.log("entre");
		//$("#error_registro").html("");
		//$("#mensaje_generico").html("");
		event.preventDefault();
		var sendData = {username:$('#username').val(),fullname:$('#fullname').val(), mensaje_pred:$('#mensaje_pred').val(), password:$('#password').val(), email:$('#email').val(),alias_asociado:$('#alias_asociado').val(),empresa:$('#empresa').val(),submit:"submit"};
		//alert($('#fullname').val()+ $('#password').val()+$('#email').val())
        $.ajax({
			url: 'includes/registrar.php',
			type: 'POST',
			data: sendData,
			success:function(data)
			{
				console.log(data);
				if (data == "" || data == null || data.includes('script') || data.includes('added'))
				{
					// alert(data);
					change_section('home');
					console.log("home");
				}
				else
				{
				    alert(data);
				}
			},
			error: function(jqXHR, textStatus, error){
				console.log(jqXHR);
			}
		});
	});
}

function login(){
	$("#login-btn-submit").click(function(event){
		event.preventDefault();
		var sendData = {username:$('#user_login').val(), password:$('#pass_login').val(), submit:'submit'};
		$.ajax({
			url: 'includes/login.php',
			type: 'POST',
			data: sendData,
			success:function(data)
			{
				if (data.includes('script'))
				{
					console.log('login');
					$("#form_login").submit();
					location.reload();
				}
				else if (data.includes('ocupado'))
				{
					$("#login-message").css("color", "#ffd500")
					$("#login-message").html("Otro conductos se encuentra logeado en la aplicacion para el movil seleccionado. Por favor, aguarde que se finalice el viaje.");
				}
				else
				{
					$("#login-message").css("color", "#ffd500")
					$("#login-message").html("El usuario o la contraseña son incorrectos.");
				}
			},
			error: function(jqXHR, textStatus, error){
				console.log(jqXHR);
			}
		});
	});
}

function restaurar_mensajes_login(){
	$("#login-message").html("");
	$(".login-input").on('input', function(){
		$("#new-acc-message").html("");
		$("#login-message").css("color", "#fff")
		$("#login-message").html("");
	});
}

function forgot(){
	$("#forgot-btn-submit").click(function(event){
		event.preventDefault();
		var sendData = {email:$('#mail_forgot').val(), submit:'submit'};
		$.ajax({
			url: 'includes/forgot.php',
			type: 'POST',
			data: sendData,
			success:function(data)
			{
				if (data.includes('script'))
				{
					$("#new-acc-message").html("Se ha enviado un mail a su cuenta, por favor siga las instrucciones");
					console.log('forgot');
					change_section('home');
				}
				else
				{
					$("#forgot-message").html("El mail no se encuentra en la base de datos.");
				}
			},
			error: function(jqXHR, textStatus, error){
				console.log(jqXHR);
			}
		});
	});
}

function forgot_pass()
{
	$("#submit_new_pass").click(function(event){
		event.preventDefault();
		var sendData = {password:$('#password').val(), submit_edit:'submit_edit'};
		$.ajax({
			url: 'includes/new_pass.php',
			type: 'POST',
			data: sendData,
			success:function(data)
			{
				if (data.includes('script'))
				{
					location.href="/?error=no-error";
				}
				else
				{
					console.log("Error recuperando contraseña");
				}
			},
			error: function(jqXHR, textStatus, error){
				console.log(jqXHR);
			}
		});
	});
}

function urlB64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/');

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}

function search_ciudades(provincia){
    // alert(provincia);
     $.ajax({
            type: "GET",
            url: 'includes/function_cityes.php',
            dataType: "json",
            data:{id: provincia},
            success: function (result) {
            // alert(result);
              //$('div').remove("#city");
               // $("#id_city").html();
               $('#id_city').find('option').remove()
                $('#id_city').append(result);
            },
            error: function (data) { alert("error") }
        });
}

function print_name() {
	$.ajax({
		url: 'ajax/print_name.php',
		dataType: 'json',
		type: 'POST',
		success:function(data) {
			$(".sidebar-top-nombre").html(data.datos);
			$(".sidebar-top-empresa").html(data.empresa);
		},
		error: function(data) { 
			alert("error")
		}
	});
}

//////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES DE LOCALIZACION
//////////////////////////////////////////////////////////////////////////////////////////


function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    latactual = position.coords.latitude ;
    longactual = position.coords.longitude;
}

function get_latactual ()
{
	return latactual;
}

function get_longactual ()
{
	return longactual;
}

function save_location ()
{
	if (($("#viaje_id").val() != undefined && $("#viaje_id").val() > 0) || ($("#travel_id").val() != undefined && $("#travel_id").val() > 0) )
	{
		console.log("Comienzo log de viaje");
		gps_interval = setInterval(function(){
			if (($("#viaje_id").val() == undefined || $("#viaje_id").val() == 0) && ($("#travel_id").val() == undefined || $("#travel_id").val() == 0))
			{
				clearInterval(gps_interval);
			}
			else
			{
				getLocation();
				var id_v = 0;
				if ($("#viaje_id").val() > 0)
					id_v = $("#viaje_id").val();
				else if ($("#travel_id").val() > 0)
					id_v = $("#travel_id").val();
				$.ajax({
			    	type: "POST",
			        url: 'ajax/registrar_posicion.php',
			        dataType: "json",
			        data: {id_viaje: id_v, lat_actual : get_latactual(), long_actual : get_longactual()},
			        success: function (result) {
			        	if (result.status == 'ok')
			        	{
			        		console.log("locacion guardada exitosamente");
			        	}
			        	else
			        	{
			        		console.log("no se pudo registrar la posicion");
			        	}		        	
			        },
			        error: function(jqXHR, textStatus, error){
						console.log(jqXHR);
					}
			    });
			}
		},10000);
	}
	else
	{
		console.log("Fallo comienzo de log de viaje");
	}
}

//////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES DEL CONDUCTOR
//////////////////////////////////////////////////////////////////////////////////////////

function buscar_viajes_nuevos()
{
	puntero_buscador = setInterval(function(){
		console.log("buscando viaje");
		 
		if (viaje_activo)
		{
			console.log("Encontre!");
			if (ruta != undefined) map.removeControl(ruta);
 			$("#loader-pedir").show();
			clearInterval(puntero_buscador);
			map.invalidateSize();
			var next_latitude = $("#latitud_viaje").val();
			var next_longitude = $("#longitud_viaje").val();
			var mensaje_popup = "Va a : "+$("#direccion_destino").val()+"<br>"+$("#observacion").val()+"<br>"+$("#mensaje").val();
	 		marcador_viaje = L.marker([next_latitude,next_longitude], {icon: L.AwesomeMarkers.icon({icon: 'spinner', prefix: 'fa', markerColor: 'red', spin:true}) }).addTo(map).bindPopup(mensaje_popup);//.bounce();
	 		map.panTo([next_latitude,next_longitude]);
			ruta = L.Routing.control({
			  waypoints: [
			    L.latLng(current_location),
			    L.latLng(next_latitude,next_longitude)
			  ],
			  router: L.Routing.mapbox('pk.eyJ1IjoidGVhbWdyZWVuIiwiYSI6ImNqbTZwcmY2ZzAyNGkzcXBhNHdzdWlheHoifQ.8P0ze1MhKd9IKR6sMjeeXA'),
			  createMarker: function() { return null; },
			  language: 'es'
			});
			ruta.addTo(map).hide();
			map.invalidateSize();
			change_section("buscar_nuevo_viaje");
			$("#div-finalizar-viaje").show();
			map.invalidateSize();
			save_location();
			$("#loader-pedir").hide();
		}
		else
		{
			chequear_por_viaje_activo();
		}
	}, 10000);
}

$("#div-finalizar-viaje").click(function(){
	$('.curtain').show();
	step_fv_to = setInterval(function(){
		$.ajax({
	    	type: "POST",
	        url: 'ajax/finalizar_viaje.php',
	        dataType: "json",
	        data: {id_viaje: $("#travel_id").val(), id_dac : $("#id_dac").val()},
	        success: function (result) {
	        	if (result.status == 'ok')
	        	{
					clearInterval(step_fv_to);					
					$.ajax({
						type: "POST",
						url: 'ajax/fixed_price.php',
						dataType: "json",
						data: {id_viaje: $("#travel_id").val()},
						success: function (result) {
							if (result.status == 'ok') {
								if (result.price > 0) {
									$("#f_amount").val(result.price);
								}
								change_section("viaje_firma");
								setTimeout(resizeCanvas(),2000);
								$('.curtain').hide();
							}
							else {
								alert("error send data -> fixed_price.php");
							}							
						},
						error: function(){
							console.log("error ajax -> fixed_price.php");
						}
					});
	        	}
	        	else
	        	{
	        		alert("No se pudo finalizar el viaje");
	        	}
	        	
	        },
	        error: function(jqXHR, textStatus, error){
				console.log(jqXHR);
			}
	    });
	},10000);	
});

function botones_mis_viajes()
{
	$("#seleccionar-viajes-anteriores").click(function()
	{
		$(".tab-proximos").hide();
		$(".tab-anteriores").show();
		$(".select-anteriores").css("background-color","#FFF");
		$(".select-proximos").css("background-color","#1A57A2");
	});

	$("#seleccionar-viajes-proximos").click(function()
	{
		$(".tab-anteriores").hide();
		$(".tab-proximos").show();
		$(".select-anteriores").css("background-color","#1A57A2");
		$(".select-proximos").css("background-color","#FFF");
	});
}

function chequear_por_viaje_activo()
{
	$.ajax({
    	type: "POST",
        url: 'ajax/check_for_active_travel.php',
        dataType: "json",
        data: {},
        success: function (result) {
        	if (result.status == "NUEVO_VIAJE")
        	{
        		$("#travel_id").val(result.travel_id);
        		$("#id_dac").val(result.id_dac);
        		$("#direccion_origen").val(result.direccion_origen);
        		$("#direccion_destino").val(result.direccion_destino);
        		$("#observacion").val(result.observacion);
        		$("#mensaje").val(result.mensaje);
        		$("#latitud_viaje").val(result.latitud_viaje);
        		$("#longitud_viaje").val(result.longitud_viaje);
        		$("#viaje_id").val(result.travel_id);
        		viaje_activo = true;
        		//return true;
        	}	
        	else 
        	{
        		console.log(result.status);
        		return false;
        	}
        },
        error: function(jqXHR, textStatus, error){
			console.log(jqXHR);
		}
    });
}

function pasar_a_firma()
{
	setTimeout(function () {
		  change_section("viaje_firma");
		  setTimeout(resizeCanvas(),2000);
      	/*$("#loader-pedir").hide();*/
    }, 5000);
}

function press_btn_firma() {
	$(".btn_p_firma").click(function() {
		$id_viaje = $(this).attr("data_id_firma");	
		console.log($id_viaje);
		$("#viaje_id").val($id_viaje)
		$.ajax({
			type: "POST",
			url: 'ajax/fixed_price.php',
			dataType: "json",
			data: {id_viaje: $("#viaje_id").val()},
			success: function (result) {
				if (result.status == 'ok') {
					if (result.price > 0) {
						$("#f_amount").val(result.price);
					}
					change_section("viaje_firma");
					setTimeout(resizeCanvas(),2000);
					$('.curtain').hide();
				}
				else {
					console.log("error send data -> fixed_price.php");
				}							
			},
			error: function(){
				console.log("error ajax -> fixed_price.php");
			}
		});
	});	
}

function press_btn_vale() {
	$(".btn_p_vale").click(function() {
		$id_viaje = $(this).attr("data_id_firma");	
		//console.log($id_viaje);
		$("#viaje_id").val($id_viaje)
		$.ajax({
			type: "POST",
			url: 'ajax/fixed_price.php',
			dataType: "json",
			data: {id_viaje: $("#viaje_id").val()},
			success: function (result) {
				if (result.status == 'ok') {
					if (result.price > 0) {
						$("#f_amount").val(result.price);
					}
					change_section("viaje_vale");
					$('.curtain').hide();
				}
				else {
					console.log("error send data -> fixed_price.php");
				}							
			},
			error: function(){
				console.log("error ajax -> fixed_price.php");
			}
		});
	});	
}

function comenzar_viaje_prueba()
{
	$("#viaje_prueba").click(function(){
		$.ajax({
			type: "POST",
	        url: 'ajax/create_test_travel.php',
	        dataType: "json",
	        data: {viaje:"viaje"},
	        success: function (result) {
	        	if (result.status == "OK")
	        	{
	        		
	        	}	
	        	else 
	        	{
	        		console.log(result.status);
	        	}
	        },
	        error: function(jqXHR, textStatus, error){
				console.log(jqXHR);
			}
		});
	});
}


//////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES DE DIRECCIONES
//////////////////////////////////////////////////////////////////////////////////////////

function cargar_direcciones()
{
	$.post("ajax/available_addresses.php", {ubi_ac:'si'}, function(mensaje) {
		direcciones_origen = mensaje;
		$(".completar-ubicacion-actual").html(direcciones_origen);
		$(".completar-ubicacion-actual-r").html(direcciones_origen);
		$(".completar-ubicacion-actual-flota").html(direcciones_origen);
		$(".completar-ubicacion-actual-r-flota").html(direcciones_origen);
		$(".completar-ubicacion-actual-esp").html(direcciones_origen);
		//geocode(get_latactual(),get_longactual())
		$(".completar-ubicacion-actual li").on('click', function(){
			$(".completar-ubicacion-actual").hide();
			var texto = $(this).text();
			console.log(texto);
			if ($(this).attr("id")=="auto-suggest") texto = $(this).data("text");
			var id = $(this).attr('data-index');
			if ($("#ubicacion-actual").is(":visible"))
			{
				$("#ubicacion-actual").val(texto);
				console.log("vision1");	
			} 
			else if ($("#ubicacion-actual-r").is(":visible"))
			{
				$("#ubicacion-actual-r").val(texto);
				console.log("vision2");	
			} 
			else if ($("#ubicacion-actual-flota").is(":visible"))
			{
				$("#ubicacion-actual-flota").val(texto);
				console.log("vision3");	
			}
			else if ($("#ubicacion-actual-r-flota").is(":visible"))
			{
				$("#ubicacion-actual-r-flota").val(texto);
				console.log("vision4");	
			}
			else if ($("#ubicacion-actual-esp").is(":visible"))
			{
				$("#ubicacion-actual-esp").val(texto);
				console.log("vision5");	
			} 
			else
			{
				console.log("estoy ciego");
			}
			$("#alias_id").val($(this).data("alias"));

			if (id=='ua')
			{
				var resultado_q = geocode(get_latactual(), get_longactual(), "ubicacion-actual");
			}
		});
	});
}



function boton_aceptar_direccion() {
	$(".btn-acept-address").click(function(){
		//Obtengo que tipo de direccion es la que esta llamando
		var tipo = $(this).data("type");

		if ($("#nueva-direccion-"+tipo).val()!="")
		{
			$('.curtain').show();
			$.ajax({
		    	type: "POST",
		        url: 'ajax/add_address.php',
		        dataType: "json",
		        data: {type:tipo,direccion:$("#nueva-direccion-"+tipo).val()},
		        success: function (result) {
		        	//change_section("home");
		        	//Aca tengo que actualizar la lista de direcciones, con un metodo "externo"
		        	actualizar_lista_direcciones();
		        	$("#popup_"+tipo).hide();
		        	$('.curtain').hide();
		        },
		        error: function(jqXHR, textStatus, error){
					console.log(jqXHR);
				}
		    });
		}
	});
}

function actualizar_lista_direcciones(){
	$.ajax({
    	type: "POST",
        url: 'ajax/update_addresses.php',
        dataType: "json",
        data: {},
        success: function (result) {
        	if (result.result=='OK')
        	{
        		$(".config-favoritos-items").html(result.direcciones);
        		popup_config();
        	}
        },
        error: function(jqXHR, textStatus, error){
			console.log(jqXHR);
		}
    });
}

function popup_config(){

	//Popup CASA
    var modal = $('#popup_casa');

    var span = $(".aceptar_casa");

    $(".config-favoritos-casa").click(function(){
        modal.css({'display' : 'block'});
        });

    span.click(function() {
            modal.css({'display' : 'none'});
        });

    //Popup TRABAJO

    var modal2 = $('#popup_trabajo');

    var span3 = $(".aceptar_trabajo");

    $(".config-favoritos-trabajo").click(function(){
        modal2.css({'display' : 'block'});
        });

    span3.click(function() {
            modal2.css({'display' : 'none'});
        });

    //Popup OTRO

    var modal3 = $('#popup_otro');

    var span5 = $(".aceptar_otro");

    $(".config-favoritos-otro").click(function(){
        modal3.css({'display' : 'block'});
        });

    span5.click(function() {
            modal3.css({'display' : 'none'});
        });

    window.onclick = function(event) {
        if (event.target == document.getElementById('popup_casa')) {
            modal.css({'display' : 'none'});
        }
        else if (event.target == document.getElementById('popup_trabajo'))
        {
        	modal2.css({'display' : 'none'});
        }
        else if (event.target == document.getElementById('popup_otro'))
        {
        	modal3.css({'display' : 'none'});
        }
    }
}

//////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES DEL PASAJERO
//////////////////////////////////////////////////////////////////////////////////////////
function check_reservation() {
	var interval_id = setInterval(function () {
	$.ajax({
		type: "POST",
		url: 'ajax/check_reservation.php',
		dataType: "json",
		success: function (result) {
			if (result.tomado == "si") {
				clearInterval(interval_id);
				console.log("Hay un viaje en progreso! ("+result.id_viaje+")");
				$("#viaje_id").val(result.id_viaje);
				pasar_a_progress()
			}
			else {
				console.log("No hay viajes en progreso");
			}
		},
		error: function (result) { console.log("error -> check_reservation.php"); }
	});
	}, 10000);	
}

function reservar_viaje () {
	$(".boton-reservar-ahora").click(function(){
		if ($("#ubicacion-actual-r").val() == undefined || $("#ubicacion-actual-r").val() == "" || $("#autocomplete_ask-r").val() == undefined || $("#autocomplete_ask-r").val() == "")
		{
			$("#error-msg-r").show();
		}
		else
		{
			$("#loader-pedir").show();
			//Placehorder : esperar 5 segundos
			setTimeout(function () {
				var ubicacion_actual = $("#ubicacion-actual-r").val();
		      	var adonde_vas = $("#autocomplete_ask-r").val();
		      	var fecha = $("#reservar-viaje-fecha").val();
		      	var hora = $("#reservar-viaje-hora").val();
		      	var comentario = $("#comment").val();
		      	var alias = $("#alias_id").val();
		      	$.ajax({
			        type: "POST",
			        url: 'includes/add_reserva.php',
			        dataType: "json",
			        data: {ubicacion_actual : ubicacion_actual, adonde_vas : adonde_vas, comentario : comentario, fecha : fecha, hora : hora, alias : alias}, 
			       	success: function (result) {
						$("#loader-pedir").hide();
						change_section("reserved_ok");
				        //pasar_a_progress();
				        if (result['id']!="" && result['id']!=undefined)
		      			{
							$("#loader-pedir").hide();
		      				$("#viaje_id").val(result['id']);
		      				save_location();
		      			}
		      			else
		      			{
		      				console.log("Fallo seteo de id");
		      				console.log(result);
		      			}
			        },
			        error: function (result) { $("#loader-pedir").hide(); console.log("error"); }
			    });

		    }, 5000);
		}
	});

	$(".boton-reservar-ahora-flota").click(function(){
		if ($("#ubicacion-actual-r-flota").val() == undefined || $("#ubicacion-actual-r-flota").val() == "" || $("#autocomplete_ask-r-flota").val() == undefined || $("#autocomplete_ask-r-flota").val() == "")
		{
			$("#error-msg-r-f").show();
		}
		else
		{
			$("#loader-pedir").show();
			//Placehorder : esperar 5 segundos
			setTimeout(function () {
				var ubicacion_actual = $("#ubicacion-actual-r-flota").val();
		      	var adonde_vas = $("#autocomplete_ask-r-flota").val();
		      	var fecha = $("#reservar-viaje-fecha-flota").val();
		      	var hora = $("#reservar-viaje-hora-flota").val();
		      	var comentario = $("#comment-r-flota").val();
		      	//var alias = $("#alias_id").val();
		      	$.ajax({
			        type: "POST",
			        url: 'includes/add_reserva_flota.php',
			        dataType: "json",
			        data: {ubicacion_actual : ubicacion_actual, adonde_vas : adonde_vas, comentario : comentario, fecha : fecha, hora : hora}, 
			       	success: function (result) {
						$("#loader-pedir").hide();
						change_section("reserved_ok");
				        //pasar_a_progress();
				        if (result['id']!="" && result['id']!=undefined)
		      			{
							$("#loader-pedir").hide();
		      				$("#viaje_id").val(result['id']);
		      				save_location();
		      			}
		      			else
		      			{
		      				console.log("Fallo seteo de id");
		      				console.log(result);
		      			}
			        },
			        error: function (result) { $("#loader-pedir").hide(); console.log("error"); }
			    });

		    }, 5000);
		}
	});

	$(".boton-reservar-ahora-esp").click(function(){
		if ($("#ubicacion-actual-esp").val() == undefined || $("#ubicacion-actual-esp").val() == "" || $("#pasajero-esp").val() == undefined || $("#pasajero-esp").val() == "" || $("#autocomplete_ask-esp").val() == undefined || $("#autocomplete_ask-esp").val() == "")
		{
			$("#error-msg-r-ve").show();
		}
		else
		{
			$("#loader-pedir").show();
			//Placehorder : esperar 5 segundos
			setTimeout(function () {
				var ubicacion_actual = $("#ubicacion-actual-esp").val();
		      	var adonde_vas = $("#autocomplete_ask-esp").val();
		      	var fecha = $("#reservar-viaje-fecha-esp").val();
		      	var hora = $("#reservar-viaje-hora-esp").val();
		      	var comentario = $("#comment-esp").val();
		      	var pasajero = $("#pasajero-esp").val();
		      	//var alias = $("#alias_id").val();
		      	$.ajax({
			        type: "POST",
			        url: 'includes/add_viaje_especial.php',
			        dataType: "json",
			        data: {ubicacion_actual : ubicacion_actual, adonde_vas : adonde_vas, comentario : comentario, fecha : fecha, hora : hora, pasajero : pasajero}, 
			       	success: function (result) {
						$("#loader-pedir").hide();
						change_section("reserved_ok");
				        //pasar_a_progress();
				        if (result['id']!="" && result['id']!=undefined)
		      			{
							$("#loader-pedir").hide();
		      				$("#viaje_id").val(result['id']);
		      				save_location();
		      			}
		      			else
		      			{
		      				console.log("Fallo seteo de id");
		      				console.log(result);
		      			}
			        },
			        error: function (result) { $("#loader-pedir").hide(); console.log("error"); }
			    });

		    }, 5000);
		}
	});

	$(".boton-pedir-ahora").click(function(){
		if ($("#ubicacion-actual").val() == undefined || $("#ubicacion-actual").val() == "" || $("#autocomplete_ask").val() == undefined || $("#autocomplete_ask").val() == "")
		{
			$("#error-msg-an").show();
		}
		else
		{
			$("#loader-pedir").show();
			//Placehorder : esperar 5 segundos
			setTimeout(function () {
				var ubicacion_actual = $("#ubicacion-actual").val();
		      	var adonde_vas = $("#autocomplete_ask").val();
		      	var comentario = $("#comment-1").val();
		      	var alias = $("#alias_id").val();
		      	$.ajax({
			        type: "POST",
			        url: 'includes/add_ask_now.php',
			        dataType: "json",
			        data: {ubicacion_actual : ubicacion_actual, adonde_vas : adonde_vas, comentario : comentario, alias : alias},
			       	success: function (result) {
						$("#loader-pedir").hide();
						change_section("progress");
				        pasar_a_progress();
				        if (result['id']!="" && result['id']!=undefined)
		      			{
							$("#loader-pedir").hide();
		      				$("#viaje_id").val(result['id']);
		      				save_location();
		      			}
		      			else
		      			{
		      				console.log("Fallo seteo de id");
		      				console.log(result);
		      			}
			        },
			        error: function (result) { $("#loader-pedir").hide(); console.log("error"); }
			    });

		    }, 5000);
		}		
	});

	$(".boton-pedir-ahora-flota").click(function(){
		if ($("#ubicacion-actual-flota").val() == undefined || $("#ubicacion-actual-flota").val() == "" || $("#autocomplete_ask_flota").val() == undefined || $("#autocomplete_ask_flota").val() == "")
		{
			$("#error-msg-an-f").show();
		}
		else
		{
			$("#loader-pedir").show();
			//Placehorder : esperar 5 segundos
			setTimeout(function () {
				var ubicacion_actual = $("#ubicacion-actual-flota").val();
		      	var adonde_vas = $("#autocomplete_ask_flota").val();
		      	var comentario = $("#comment-1-flota").val();
		      	//var alias = $("#alias_id").val();
		      	$.ajax({
			        type: "POST",
			        url: 'includes/add_ask_now_flota.php',
			        dataType: "json",
			        data: {ubicacion_actual : ubicacion_actual, adonde_vas : adonde_vas, comentario : comentario},
			       	success: function (result) {
						$("#loader-pedir").hide();
						change_section("progress");
				        pasar_a_progress();
				        if (result['id']!="" && result['id']!=undefined)
		      			{
							$("#loader-pedir").hide();
		      				$("#viaje_id").val(result['id']);
		      				save_location();
		      			}
		      			else
		      			{
		      				console.log("Fallo seteo de id");
		      				console.log(result);
		      			}
			        },
			        error: function (result) { $("#loader-pedir").hide(); console.log("error"); }
			    });

		    }, 5000);
		}		
	});
}

function pasar_a_progress() {
	var interval_id;
	interval_id = setInterval(function () {
		$.ajax({
			type: "POST",
			url: 'cms/api/check_travel.php',
			dataType: "json",
			data: {travel_id : $("#viaje_id").val()},
			success: function (result) {
				if (result['cancelado']=="si") {	
						clearInterval(interval_id);
						console.log("Se canceló el viaje");
						setTimeout(function () {
							$("#loader-pedir").hide();
							change_section("travel_canceled");     	
						}, 5000);
				}
				else if (result['msg']=="OK")
				{
					if (result['viaje_aceptado']== "SI")
					{			
						$('.mpr-div-texto-dato-auto').html(result.datos);	
						clearInterval(interval_id);
						console.log("Se tomo el viaje!");
						setTimeout(function () {
							$("#loader-pedir").hide();
							change_section("middle_page_ask_now");     	
							check_outside();
						}, 5000);

					}
					else
					{
						console.log("Todavia no se tomo el viaje!");
					}
				}
				else
				{
					console.log("Algo salio mal");
				}
			},
			error: function (result) { alert("error") }
		});
	}, 10000);	
}

function check_outside() {
	var interval_id;
	interval_id = setInterval(function () {
		$.ajax({
			type: "POST",
			url: 'ajax/check_outside.php',
			dataType: "json",
			data: {travel_id : $("#viaje_id").val()},
			success: function (data) {
				if (data.canceladdo == "si") {	
					clearInterval(interval_id);
					console.log("Se canceló el viaje");
					setTimeout(function () {
						change_section("travel_canceled");     	
					}, 2000);
				}
				if (data.afuera == "si") {	
					clearInterval(interval_id);
					console.log("El chofer está afuera");
					setTimeout(function () {
						change_section("driver_outside"); 
						pasar_a_calificacion();   	
					}, 2000);
				} else {
					console.log("Todavia no llegó el chofer");
				}
			},
			error: function (data) { console.log('error -> check_outside.php') }
		});		
	},5000);
}

$("#back_home").click(function() {
	change_section('home');
});

function pasar_a_calificacion() {
	var interval_id;
	interval_id = setInterval(function () {
		$.ajax({
			type: "POST",
			url: 'ajax/check_end_travel.php',
			dataType: "json",
			data: {travel_id : $("#viaje_id").val()},
			success: function (data) {
				if (data.cancelado == "si") {	
					clearInterval(interval_id);
					console.log("Se canceló el viaje");
					setTimeout(function () {
						change_section("travel_canceled");     	
					}, 5000);
				}
				if (data.viaje_finalizado == "si") {				
					clearInterval(interval_id);
					console.log("Se finalizó el viaje!");
					setTimeout(function () {
						change_section("viaje_calificar");
						// pasar_a_firma();
						/*$("#loader-pedir").hide();*/
					}, 2000);
				} else {
					console.log("Todavia no se finalizo el viaje!");
				}
			},
			error: function (data) { alert("error") }
		});
		
	},10000);
}

//////////////////////////////////////////////////////////////////////////////////////////
//FUNCIONES DE CONDUCTOR/PASAJERO
//////////////////////////////////////////////////////////////////////////////////////////

// CALIFICACIONES.
function calificar(miCalificacion){
	var calificacion = $('#valor_'+miCalificacion).val();
	var id_viaje = $("#travel_id").val();

	$.ajax({
			url: 'ajax/calificar_viaje.php',
			type: 'POST',
			dataType: 'json',
			data: { calificacion, id_viaje },
			success: function(data) {
				console.log(data.id_user);
				console.log(data.calificado);
				console.log(data.insert);
				$("#travel_id").val("");
				$("#viaje_id").val("");
				change_section("home");
				$.ajax({
					url: 'ajax/check_is_driver.php',
					type: 'POST',
					dataType: 'json',
					data: {},
					success: function(data) {
						if (data.is_driver == "OK")
						{
							console.log("buscando...");
							viaje_activo = false;
							buscar_viajes_nuevos();
						}
						console.log(data.is_driver);						
					},
					error: function(data) {
							console.log("error ajax -> check_is_driver.php");
					}
				});
			},
			error: function(data) {
					console.log("error ajax -> calificar_viaje.php");
			}
	});

};

$("#califico_1").on('click', ()=>{ calificar("califico_1"); });
$("#califico_2").on('click', ()=>{ calificar("califico_2"); });
$("#califico_3").on('click', ()=>{ calificar("califico_3"); });
$("#califico_4").on('click', ()=>{ calificar("califico_4"); });
$("#califico_5").on('click', ()=>{ calificar("califico_5"); });


//MIS VIAJES
function mis_viajes() {
	var id_viaje = $("#viaje_id").val();
	console.log(id_viaje);

	$.ajax({
			url: 'ajax/mis_viajes.php',
			type: 'POST',
			dataType:"json",
			data: { id_viaje },
			success: function(data) {
				//console.log(data.id_user);
				if (data.status=='ok') {
					$('#tab_viajes').html(data.datos);
					info_travel();	
					press_btn_pending_review();	
					press_btn_firma();
					press_btn_vale();				
				}else{
					$('#tab_viajes').html(data.noDatos);					
				}
			},
			error: function(data) {
				console.log("error ajax -> mis_viajes.php");
			}
	});

	$.ajax({
			url: 'ajax/next_travels.php',
			type: 'POST',
			dataType:"json",
			data: { id_viaje },
			success: function(resultado) {
				//console.log(data.id_user);
				if (data.status=='ok') {
					$('#tab_next').html(resultado.datos);					
				}else{
					$('#tab_next').html(resultado.noDatos);					
				}
			},
			error: function(resultado) {
				console.log("error ajax -> next_travels.php");
			}
	});
}

$("#close_info_travel").click(function(){
	$("#info_travel").hide();
});

function info_travel() {
	$(".div_travel").click(function() {
		var id_viaje = $(this).attr("data_id");	
		console.log(id_viaje);
		$.ajax({
			url: 'ajax/travel_state.php',
			type: 'POST',
			dataType:"json",
			data: { id_viaje },
			success: function(data) {
				if (data.status=='ok') {
					$("#body_state_table").html(data.content);
					$("#info_travel").show();				
				}
			},
			error: function(data) {
				console.log("error ajax -> travel_state.php");
			}
		});
	})
}

// $("#btn_pending").click(function() {
// 	$("#pending_review").hide();
// });

// $("#close_pending").click(function() {
// 	$("#pending_review").hide();
// });

// function check_pending_review() {
// 	$.ajax({
// 		url: 'ajax/check_pending_review.php',
// 		type: 'POST',
// 		dataType:"json",
// 		success: function(data) {
// 			if (data.pendiente == 'si') {
// 				console.log("hay reviews pendientes")
// 				$('#pending_review').show();					
// 			}else{
// 				console.log("no hay reviews pendientes")					
// 			}
// 		},
// 		error: function(data) {
// 			console.log("error ajax");
// 		}
// 	});
// }

function press_btn_pending_review() {
	$(".btn_p_review8").click(function() {
		$id_viaje = this.id;
		console.log($id_viaje);
		$("#travel_id").val($id_viaje);
		change_section("viaje_calificar");
	});	
}

function choose_name() {
	console.log('asdasdadada');
	$.ajax({
		url: 'ajax/choose_name.php',
		type: 'POST',
		dataType:"json",
		success: function(response) {
			console.log('algo mal');
			if (response.status == 'ok') {
				console.log('status ok');
				if (response.cant_chofer == 'varios') {
					console.log('hay varios');
					$('#chofer-name').append(response.content);
					$('#choose_name').show();
				} else {
					console.log('no hay varios');
				}			
			} else {
				console.log('todo mal');
			}
		},
		error: function(data) {
			console.log("error ajax -> choose_name.php");
		}
	});
}

function select_name() {
	var name = $('#chofer-name').val();
	$('.sidebar-top-nombre').html(name);
	$('#choose_name').hide();
}


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#canvasVale').attr('src', e.target.result);
            //$('#canvasVale').attr('val', e.target.result);
            var canvas = document.getElementById("canvasVale");
            var ctx = canvas.getContext('2d');
            var img = new Image();
	        img.onload = function(){
	            canvas.width = img.width;
	            canvas.height = img.height;
	            ctx.drawImage(img,0,0);
	            $("#btn_send_vale").attr("disabled",false);
	        }
	        img.src = e.target.result;
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#foto-vale").off("change").on("change",function(){
    $("#btn_send_vale").attr("disabled","disabled");
    readURL(this);
    console.log("cambie la foto, no?");    
});

$("#boton-sacar-foto").off("click").on("click",function(){
	$("#foto-vale").click();
});