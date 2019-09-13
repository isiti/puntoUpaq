// INFO: ARCHIVO FUNCTIONS.JS SE USA PARA TRABAJAR CON "JQUERY".
// NOTA: si se prefiere trabajar con JavaScript puro usar el archivo src-es6/functionsES6.js y compilarlo con babel.

"use strict";


var mymap;
var ruta;
var flag;


$(document).ready(function() {
  // Invocamos funciones.
  seeOrders(); // muestro oculto secciones
  seePedidos();
  text3d(); //efecto texto 3d
  showInfoUser(); // muestra info del cadete en el perfil.
  editUser(); // editar usuario.
  newUser(); // alta de usuario.
  showInfoOrder(); // muestra info del pedido.
  backHome(); // volver al home
  confirmAceptado(); // cambia estado a 'Aceptado'
  confirmBuscando(); // cambia estado a 'buscando'
  confirmEntregando(); // cambiar estado a 'entregando'
  confirmCompletado(); // cambiar estado a 'completado'
  confirmCanelado(); // cambia estado a 'cancelado'
  // map(); // leaflet mapa
  // testCoordenadas(); // testear las obtencion de coordenadas.  
  reloadTable();
  showMyOrders();
  $('#table_cadetes_dow').hide;
});


// declaro mis funciones.
function sideBar() {
  $("#sidebar-action").on("click", function() {
    $("#sidebar").toggleClass("active");
  });
}


// efecto 3d texto
function text3d() {
  jQuery(document).ready(function() {
    $("h1").mousemove(function(e) {
      var rXP = e.pageX - this.offsetLeft - $(this).width() / 2;
      var rYP = e.pageY - this.offsetTop - $(this).height() / 2;
      $("h1").css(
        "text-shadow",
        +rYP / 10 +
          "px " +
          rXP / 80 +
          "px #ff5840, " +
          rYP / 8 +
          "px " +
          rXP / 60 +
          "px rgba(255,237,0,1), " +
          rXP / 70 +
          "px " +
          rYP / 12 +
          "px #253d7a"
      );
    });
  });
}


// inicializo el mapa
function map(lat_origen, long_origen, lat_destino, long_destino, direc_origen, direc_destino, name_user, destinatario) {
  // creo mi mapa
  mymap = L.map("mapid").setView([-38.70144, -62.269374], 14);
  L.tileLayer(
    "https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidGVhbWdyZWVuIiwiYSI6ImNqbTZwcmY2ZzAyNGkzcXBhNHdzdWlheHoifQ.8P0ze1MhKd9IKR6sMjeeXA",
    {
      attribution:
        'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
      maxZoom: 15,
      id: "mapbox.streets",
      accessToken:
        "pk.eyJ1IjoidGVhbWdyZWVuIiwiYSI6ImNqbTZwcmY2ZzAyNGkzcXBhNHdzdWlheHoifQ.8P0ze1MhKd9IKR6sMjeeXA"
    }
  ).addTo(mymap);
  mymap.scrollWheelZoom.disable();

  // GeoCoder
  // L.Control.geocoder().addTo(map);

  var coord_origen = [lat_origen, long_origen];
  var coord_destino = [lat_destino, long_destino];
  
  // marcadores.
  var origen = L.marker(coord_origen).addTo(mymap)
        .bindPopup(`
          <div>
            <b>Origen: </b> ${direc_origen}
            <br>
            <b>Entrega: </b> ${name_user}
          </div>
        `);       

  var destino = L.marker(coord_destino).addTo(mymap)
        .bindPopup(`
          <div>
            <b>Destino: </b> ${direc_destino}
            <br>
            <b>Recibe: </b> ${destinatario}
          </div>
        `); 

  

  // dibujar trazo entre marcadores.
  drawTravel(coord_origen, coord_destino);

  mymap.invalidateSize(); // renderizo y optimizo la carga del mapa.
}


// dibujar recorrido entre dos puntos.
function drawTravel(origen, destino){
  if (ruta != undefined) mymap.removeControl(ruta);
  mymap.invalidateSize();
              
  ruta = L.Routing.control({
    waypoints: [
      L.latLng(origen),
      L.latLng(destino)
    ],
    routeWhileDragging: true,
    geocoder: L.Control.Geocoder.nominatim(), // agregamos geocoder.      
    router: L.Routing.mapbox('pk.eyJ1IjoidGVhbWdyZWVuIiwiYSI6ImNqbTZwcmY2ZzAyNGkzcXBhNHdzdWlheHoifQ.8P0ze1MhKd9IKR6sMjeeXA'),
    createMarker: function() { return null; },
    language: 'es'
  });

  ruta.addTo(mymap).hide();
}


// devuelvo contenido del pedido en formato de tabla.
function orderClientTable(datos, tabla) {
  var data;  

  for (var valor of datos) {
    data += `
            <tr class="row-order order-${valor.mode}" id="${valor.id}" data-mode="${valor.mode}" title="pedido de DOW">
                <th>${valor.fModificacion}</th>                                
                <td>${valor.origen}</td>
                <td>${valor.destino}</td>
                <td>${valor.tipo}</td>     
            </tr>               
        `;
    $('#'+tabla).html(data);    
    showInfoOrder();
  }
}

// obtengo info del pedido seleccionado.
function showInfoOrder() {
  $(".row-order").on("click", function() {
    limpiarCampos();   

    let dataSend = {
      id: $(this).attr("id"),
      mode: $(this).data('mode')
    };

    $('#confirmar-pedido').attr('data-mode', dataSend.mode);

    $.ajax({
      url: "server/http_request/show_info_order.php",
      type: "GET",
      dataType: "json",
      data: dataSend,
      success: function(resp) {        
        let html;        

        for (const data of resp.orders) {
          $("#id_order_value").attr("value", data.id);

          if(dataSend.mode == 'upaq'){           
            html = `
              <div class="col-lg-12 col-md-12 col-xs-12">                                               
                <div class="info-pedido">                    
                    <p>Estado del pedido: ${data.status.toUpperCase()}</p>                            
                    <p>Solicitante: ${data.user}</p>                    
                    <p>Destinatario: ${data.destinatario}</p>                    
                    <hr>
                    <p>Detalle: ${data.descripcion}</p>
                    <hr>
                    <p>Fecha de Pedido: ${data.fCreacion}</p>
                    <p>Última modificación: ${data.fModificacion}</p>                     
                    <p>Origen: ${data.origen} - depto: ${data.depto_origen}</p>
                    <p>Destino: ${data.destino} - depto: ${data.depto_destino}</p>        
                    <hr>
                </div>
            </div>
            `;   

            $('#info-order').html(html);

            var name_user = data.name + ' ' + data.lastname;
            // muestro y actualizo el mapa.
            document.getElementById("maps").innerHTML = "<div id='mapid' style='width: 100%; height: 100%;'></div>";
            // creo el mapa.
            map(
              data.lat_origen,
              data.long_origen,
              data.lat_destino,
              data.long_destino,
              data.origen ,
              data.destino,
              name_user,
              data.destinatario
            );

            // info user
            for (const data of resp.users) {
              html = `                
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <p>Nombre: ${data.name} ${data.lastname}</p>
                    <p>Email: ${data.email}</p>
                    <p>Teléfono: ${data.phone}</p>
                </div> 
              `;          
            }
            $('#info-cliente').html(html);
          }

          if(dataSend.mode == 'dow'){       
            html = `
              <div class="col-lg-12 col-md-12 col-xs-12">                
                <img src="./assets/images/logos/dow_logo.png" alt="logo" width="25%" style="text-align:center;">
                <hr>
                <div class="info-pedido">
                    <p>Prioridad: ${data.prioridad}</p>
                    <p>Estado del pedido: ${data.status.toUpperCase()}</p>
                    <hr>
                    <p>N° Solicitante: ${data.n_solicitante}</p>
                    <p>Solicitante: ${data.solicitante}</p>                    
                    <p>Aprobador: ${data.aprobador}</p>                    
                    <p>Proveedor: ${data.proveedor}</p>
                    <p>Contacto: ${data.contacto}</p>
                    <hr>
                    <p>Detalle: ${data.detalle}</p>
                    <hr>
                    <p>Fecha de Pedido: ${data.fCreacion}</p>
                    <p>Última modificación: ${data.fModificacion}</p>                     
                    <p>Origen: ${data.origen}</p>
                    <p>Destino: ${data.destino}</p>                        
                </div>
            </div>
            `;   

            $('#info-order').html(html);

            var name_user = data.solicitante;
            // muestro y actualizo el mapa.
            document.getElementById("maps").innerHTML = "<div id='mapid' style='width: 100%; height: 100%;'></div>";
            // creo el mapa.
            map(
              data.lat_origen,
              data.long_origen,
              data.lat_destino,
              data.long_destino,
              data.origen ,
              data.destino,
              name_user,
              data.proveedor
            );
          }
        }
        

        // muesto y oculto
        seeInfo();
      },
      error: function(jqXHR, textStatus, error) {
        console.log(jqXHR + "-" + textStatus + "-" + error);
      }
    });
  });
}

// muestro informacion de pedidos.
function showOrders(flag) {  

  $.ajax({
    url: "server/http_request/show_orders.php",
    type: "GET",
    dataType: "json",
    data: {flag: flag},
    success: function(resp) {   
      console.log(resp);           
      let orders = [...resp.orders, ...resp.dow];      
      orderClientTable(orders, 'table_cadetes');
    },
    error: function(jqXHR, textStatus, error) {
      console.log(jqXHR + "-" + textStatus + "-" + error);
    }
  });
}



// muestra las ordenes.
function showMyOrders() {
  $('#btn-pedidos').on('click', ()=>{
    $.ajax({
      url: "server/http_request/show_orders.php",
      type: "GET",
      data: { flag: 'my_orders' },
      dataType: "json",
      success: function(resp) {      
        console.log(resp);      
        let orders = [...resp.orders, ...resp.dow]; 
        orderClientTable(orders, 'tableMyOrders');            
      },
      error: function(jqXHR, textStatus, error) {
        console.log(jqXHR + "-" + textStatus + "-" + error);
      }
    });
  });
}



// recarga las tablas.
function reloadTable() { 
  setTimeout( ()  =>  { showOrders('orders'); }, 1000);
  setInterval( () =>  { showOrders('orders'); }, 5000);
  setTimeout( ()  =>  { showOrders('dow');    }, 1000);
  setInterval( () =>  { showOrders('dow');    }, 5000);
}


// limpia los campos
function limpiarCampos() {
  // info order
  $("#id_order_value").attr("value", "");
  $("#origen").html("");
  $("#destino").html("");
  $("#tipo").html("");
  $("#destinatario").html("");
  $("#descripcion").html("");
}


// limpiar mapa
function limpiarMapa() {
  mymap.remove();
}


// muestra la tabla de ordenes
function seeOrders() {
  $("#orders").show();
  $("#presentacion").show();
  $("#pedidos").hide();

  $("#info").hide();
  $("#end").hide();
  $("#btn-float").hide();
}


// muestra la seccion de info
function seeInfo() {
  $("#info").show();
  $("#btn-float").show();
  mymap.invalidateSize(); // mejora la carga del mapa.

  $("#orders").hide();
  $("#end").hide();
  $("#presentacion").hide();
}


// muestra la seccion de mis pedidos
function seePedidos() {
  $("#pedidos").hide();

  $("#btn-pedidos").on("click", function() {
    $("#pedidos").show();
    $("#orders").hide();

    $("#btn-dropdown").click();
    //$("#end").hide();
    //$("#presentacion").show();
  });

  //$("#btn-float").show();
  //mymap.invalidateSize(); // mejora la carga del mapa.
}


// muestra mensaje de cierre
function seeEnd() {
  $("#end").show();

  $("#btn-float").hide();
  $("#info").hide();
  $("#orders").hide();
  $("#presentacion").hide();
}


// vuelve al home
function backHome() {
  $("#back-home").on("click", () => {
    seeOrders();
    limpiarMapa();
  });
}


// aceptar un pedido
function confirmAceptado() {
  $("#confirmar-pedido").on("click", () => {
    notie.confirm({
      text: "¿Quiere <b>ACEPTAR</b> el viaje? ",
      cancelCallback: function() {
        notie.alert({ type: 3, text: ":( que mal", time: 2 });
        console.log("error");
        seeOrders();
      },
      submitCallback: function() {
        notie.alert({ type: 1, text: ":D Excelente noticias", time: 2 });
        console.log("exito");

        $("#confirmar-pedido").hide();
        $("#action-pedido").show();

        $("#back-home").hide();
        $("#cancelar-pedido").show();

        var id = $("#id_order_value").val();
        var status = "aceptado";
        let mode = $('#confirmar-pedido').data('mode');        
        let dataSend = {
          id: id,
          status: status,
          mode: mode
        };

        $.ajax({
          url: "server/http_request/change_status_order.php",
          type: "POST",
          dataType: "json",
          data: dataSend,
          success: function(data) {
            console.log(data);

            if (data.success) {
              //envio email al cliente
              console.log(id);
              $.ajax({
                url: "server/http_request/send_mail.php",
                method: "POST",
                dataType: "json",
                data: { id, type: "accept" },
                success: function(data) {
                  console.log(data);
                },
                error: function(data) {
                  console.log(data);
                }
              });
            }
          },
          error: function(jqXHR, textStatus, error) {
            console.log(jqXHR + "-" + textStatus + "-" + error);
          }
        });
      }
    });
  });
}


// cambiar estado a -> buscando
function confirmBuscando() {
  $("#btn-buscando").on("click", function() {
    notie.confirm({
      text: "¿Se dirige a <b>BUSCAR</b> el paquete? ",
      cancelCallback: function() {
        notie.alert({
          type: 3,
          text: "No hay problema, avisanmos cuando estes listo ",
          time: 2
        });
        console.log("error");
      },
      submitCallback: function() {
        notie.alert({ type: 1, text: ":D Excelente noticias", time: 2 });
        console.log("exito");

        var id = $("#id_order_value").val();
        var status = "buscando";
        let mode = $('#confirmar-pedido').data('mode');        
        let dataSend = {
          id: id,
          status: status,
          mode: mode
        };

        $.ajax({
          url: "server/http_request/change_status_order.php",
          type: "POST",
          dataType: "json",
          data: dataSend,
          success: function(data) {
            console.log(data);
            $(".estado-viaje").html("Buscando paquete");

            if (data.success) {
              //envio email al cliente
              $.ajax({
                url: "server/http_request/send_mail.php",
                method: "POST",
                dataType: "json",
                data: { id, type: "search" },
                success: function(data) {
                  console.log(data);
                }
              });
            }
          },
          error: function(jqXHR, textStatus, error) {
            console.log(jqXHR + "-" + textStatus + "-" + error);
          }
        });
      }
    });
  });
}


// cambiar estado a -> entregando
function confirmEntregando() {
  $("#btn-entregando").on("click", function() {
    notie.confirm({
      text: "¿Se dirige a <b>ENTREGAR</b> el paquete? ",
      cancelCallback: function() {
        notie.alert({
          type: 3,
          text: "No hay problema, avisanmos cuando estes listo ",
          time: 2
        });
        console.log("error");
      },
      submitCallback: function() {
        notie.alert({ type: 1, text: ":D Excelente noticias", time: 2 });
        console.log("exito");

        var id = $("#id_order_value").val();
        var status = "entregando";
        let mode = $('#confirmar-pedido').data('mode');        
        let dataSend = {
          id: id,
          status: status,
          mode: mode
        };

        $.ajax({
          url: "server/http_request/change_status_order.php",
          type: "POST",
          dataType: "json",
          data: dataSend,
          success: function(data) {
            console.log(data);
            $(".estado-viaje").html("Entregando paquete");

            if (data.success) {
              //envio email al cliente
              $.ajax({
                url: "server/http_request/send_mail.php",
                method: "POST",
                dataType: "json",
                data: { id, type: "entregando" },
                success: function(data) {
                  console.log(data);
                }
              });
            }
          },
          error: function(jqXHR, textStatus, error) {
            console.log(jqXHR + "-" + textStatus + "-" + error);
          }
        });
      }
    });
  });
}


// cambiar estado a -> completo
function confirmCompletado() {
  $("#btn-completado").on("click", function() {
    notie.confirm({
      text: "¿Entregó el paquete correctamente y <b>COMPLETO</b> el viaje? ",
      cancelCallback: function() {
        notie.alert({
          type: 3,
          text: "No hay problema, avisanmos cuando entregues el paquete ",
          time: 2
        });
        console.log("error");
      },
      submitCallback: function() {
        notie.alert({ type: 1, text: ":D Excelente noticias", time: 2 });
        console.log("exito");

        var id = $("#id_order_value").val();
        var status = "completado";
        let mode = $('#confirmar-pedido').data('mode');        
        let dataSend = {
          id: id,
          status: status,
          mode: mode
        };

        $.ajax({
          url: "server/http_request/change_status_order.php",
          type: "POST",
          dataType: "json",
          data: dataSend,
          success: function(data) {
            console.log(data);
            $(".estado-viaje").html("viaje completado");
            seeEnd();

            if (data.success) {
              //envio email al cliente
              $.ajax({
                url: "server/http_request/send_mail.php",
                method: "POST",
                dataType: "json",
                data: { id, type: "completado" },
                success: function(data) {
                  console.log(data);
                }
              });
            }
          },
          error: function(jqXHR, textStatus, error) {
            console.log(jqXHR + "-" + textStatus + "-" + error);
          }
        });
      }
    });
  });
}


// cambiar estado a -> sin_iniciar (cancelo el pedido) & limpio el cadete
function confirmCanelado() {
  $("#cancelar-pedido").on("click", function() {
    notie.confirm({
      text: "¿quiere <b>CONTINUAR</b> el viaje o <b>CANCELARLO</b>? ",
      cancelCallback: function() {
        notie.alert({ type: 3, text: ":( que lastima", time: 2 });
        console.log("error");

        var id = $("#id_order_value").val();
        var status = "sin_iniciar";
        let mode = $('#confirmar-pedido').data('mode');        
        let dataSend = {
          id: id,
          status: status,
          mode: mode
        };

        $.ajax({
          url: "server/http_request/change_status_order.php",
          type: "POST",
          dataType: "json",
          data: dataSend,
          success: function(data) {
            console.log(data);
            seeOrders();
          },
          error: function(jqXHR, textStatus, error) {
            console.log(jqXHR + "-" + textStatus + "-" + error);
          }
        });
      },
      submitCallback: function() {
        notie.alert({ type: 1, text: ":D Excelente noticias", time: 2 });
        console.log("exito");
      }
    });
  });
}


// traigo y muestro info del cadete
function showInfoUser() {
  $.ajax({
    url: "server/http_request/show_info_user.php",
    type: "POST",
    dataType: "json",
    success: function(data) {
      console.log("lalalala");
      // perfil
      $("#info_username").html(data.name + " " + data.lastname);
      $("#info_email").html(data.email);
      $("#info_password").html(data.password);
      $("#info_phone").html(data.phone);
      $("#info_orders").html(data.orders);

      // formulario
      $("#edit_name").attr("value", data.name);
      $("#edit_lastname").attr("value", data.lastname);
      $("#edit_email").attr("value", data.email);
      $("#edit_phone").attr("value", data.phone);
      $("#edit_orders").attr("value", data.orders);
    },
    error: function(jqXHR, textStatus, error) {
      console.log(jqXHR + "-" + textStatus + "-" + error);
    }
  });
}


// edito usuario.
function editUser() {
  $("#btn_editar").on("click", e => {
    e.preventDefault();

    var name = $("#edit_name").val();
    var lastname = $("#edit_lastname").val();
    var email = $("#edit_email").val();
    var password = $("#edit_password").val();
    var phone = $("#edit_phone").val();

    name == "" || name == null
      ? $("#success_name").html(
          '<span style="color:red;"><i class="fas fa-times"></i> Ingrese un name</span>'
        )
      : $("#success_name").html(
          '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
        );

    lastname == "" || lastname == null
      ? $("#success_lastname").html(
          '<span style="color:red;"><i class="fas fa-times"></i> Ingrese un lastname</span>'
        )
      : $("#success_lastname").html(
          '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
        );

    email == "" || email == null
      ? $("#success_email").html(
          '<span style="color:red;"><i class="fas fa-times"></i> Ingrese un email</span>'
        )
      : $("#success_email").html(
          '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
        );

    password == "" || password == null
      ? $("#success_password").html(
          '<span style="color:red;"><i class="fas fa-times"></i> Ingrese un password</span>'
        )
      : $("#success_password").html(
          '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
        );

    phone == "" || phone == null
      ? $("#success_phone").html(
          '<span style="color:red;"><i class="fas fa-times"></i> Ingrese un phone</span>'
        )
      : $("#success_phone").html(
          '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
        );

    $.ajax({
      url: "server/http_request/edit_user.php",
      type: "POST",
      dataType: "json",
      data: {
        name: name,
        lastname: lastname,
        email: email,
        password: password,
        phone: phone
      },
      success: function(data) {
        if (data.success == false) {
          console.log("error, complete todos los campos");
        } else {
          console.log("todo ok");
          location.reload();
        }
      },
      error: function(jqXHR, textStatus, error) {
        console.log(jqXHR + "-" + textStatus + "-" + error);
      }
    });
  });
}


// alta de usuario.
function newUser() {
  $("#btn_registrar").on("click", e => {
    e.preventDefault();

    var name = $("#name").val();
    var lastname = $("#lastname").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var phone = $("#phone").val();
    var error = 0;

    if (name == "" || name == null) {
      $("#success_name").html(
        '<span style="color:red;"><i class="fas fa-times"></i> Ingrese un name</span>'
      );
      error = +1;
    } else {
      $("#success_name").html(
        '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
      );
      error = 0;
    }

    if (lastname == "" || lastname == null) {
      $("#success_lastname").html(
        '<span style="color:red;"><i class="fas fa-times"></i> Ingrese un lastname</span>'
      );
      error = +1;
    } else {
      $("#success_lastname").html(
        '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
      );
      error = 0;
    }

    if (email == "" || email == null) {
      $("#success_email").html(
        '<span style="color:red;"><i class="fas fa-times"></i> Ingrese un email</span>'
      );
      error = +1;
    } else {
      $("#success_email").html(
        '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
      );
      error = 0;
    }

    if (password == "" || password == null) {
      $("#success_password").html(
        '<span style="color:red;"><i class="fas fa-times"></i> Ingrese un password</span>'
      );
      error = +1;
    } else {
      $("#success_password").html(
        '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
      );
      error = 0;
    }

    if (phone == "" || phone == null) {
      $("#success_phone").html(
        '<span style="color:red;"><i class="fas fa-times"></i> Ingrese un phone</span>'
      );
      error = +1;
    } else {
      $("#success_phone").html(
        '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
      );
      error = 0;
    }

    if (error == 0) {
      $.ajax({
        url: "server/http_request/new_user.php",
        type: "POST",
        dataType: "json",
        data: {
          name: name,
          lastname: lastname,
          email: email,
          password: password,
          phone: phone
        },
        success: function(data) {
          if (data.success == false) {
            console.log("error, complete todos los campos");
          } else {
            console.log("todo ok");
            location.reload();
          }
        },
        error: function(jqXHR, textStatus, error) {
          console.log(jqXHR + "-" + textStatus + "-" + error);
        }
      });
    }
  });
}


// teste obtener coordenadas.
function testCoordenadas() {
  $("#test").on("click", () => {
    var origen = "alem 625";
    var destino = "alem 1000";
    var id = "1";

    $.ajax({
      url: "server/http_request/coordinates.php",
      type: "POST",
      dataType: "json",
      data: { id, origen, destino },
      success: function(data) {
        console.log(data);
      },
      error: function(jqXHR, textStatus, error) {
        console.log(jqXHR + "-" + textStatus + "-" + error);
      }
    });
  });
}

