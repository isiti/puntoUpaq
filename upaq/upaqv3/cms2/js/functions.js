// INFO: ARCHIVO FUNCTIONS.JS SE USA PARA TRABAJAR CON "JQUERY".
// NOTA: si se prefiere trabajar con JavaScript puro usar el archivo src-es6/functionsES6.js y compilarlo con babel.

"use strict";

$(document).ready(function() {
  // Invocamos funciones.
  sideBar(); // cambia icono en la barra lateral.
  loadTables();
  newOrder();
  showTarifas();
  modTarifas();
});

// declaro mis funciones.
function sideBar() {
  $("#sidebar-action").on("click", function() {
    $("#sidebar").toggleClass("active");
  });
}

function loadTables() {
  getTable("users");
  getTable("orders");
  getTable("cadets");
}

function getTable(tableName) {
  $.ajax({
    url: "server/api/api.php",
    method: "GET",
    dataType: "json",
    data: { tableName },
    success: function(response) {
      switch (tableName) {
        case "users":
          dataUsers(response, tableName);
          break;
        case "cadets":
          dataUsers(response, tableName);
          break;
        case "orders":
          dataOrders(response);
          break;
      }
    }
  });
}

function dataUsers(data, tableName) {
  var html = "";

  for (var i = 0; i < data.length; i++) {
    html +=
      "<tr id='" +
      data[i].id +
      "'><td>" +
      data[i].name +
      "</td><td>" +
      data[i].lastname +
      "</td><td>" +
      data[i].email +
      "</td><td>" +
      data[i].phone +
      "</td></tr>";
  }

  switch (tableName) {
    case "users":
      $("#table_users tbody").html(html);
    case "cadets":
      $("#table_cadets tbody").html(html);
  }
}

function dataOrders(data) {
  var html = "";

  for (var i = 0; i < data.length; i++) {
    html +=
      "<tr id='" +
      data[i].id +
      "'><td>" +
      data[i].origen +
      "</td><td>" +
      data[i].depto_origen +
      "</td><td>" +
      data[i].destino +
      "</td><td>" +
      data[i].depto_destino +
      "</td><td>" +
      data[i].tipo +
      "</td><td>" +
      data[i].destinatario +
      "</td><td>"+
      data[i].user +
      "</td><td>" +
      data[i].cadete +
      "</td><td>" +
      data[i].status +
      "</td></tr>";
  }

  $("#table_orders tbody").html(html);
}

$("#content-cadets").hide();
$("#content-users").hide();
$("#content-tarifas").hide();

$(".btn-sec").on("click", function() {
  var id = $(this).data("sec");

  $("#content-orders").hide();
  $("#content-cadets").hide();
  $("#content-users").hide();
  $("#content-tarifas").hide();

       if (id == 1) $("#content-orders").show();
  else if (id == 2) $("#content-cadets").show();
  else if (id == 3) $("#content-users").show();
  else if (id == 4) $("#content-tarifas").show();
});

function newOrder() {
  $("#btn-submit").on("click", () => {
    var origen = $("#form_newOrder")
      .find("input[name='direc_origen']")
      .val();
    var depto_origen = $("#form_newOrder")
      .find("input[name='depto_origen']")
      .val();
    var destino = $("#form_newOrder")
      .find("input[name='direc_destino']")
      .val();
    var depto_destino = $("#form_newOrder")
      .find("input[name='depto_destino']")
      .val();
    var tipo = $("#form_newOrder")
      .find("select[name='tipo']")
      .val();
    var descripcion = $("#form_newOrder")
      .find("textarea[name='descripcion']")
      .val();
    var destinatario = $("#form_newOrder")
      .find("input[name='destinatario']")
      .val();

    origen == "" || origen == null
      ? $("#origen_help").html(
          '<span style="color:red;"><i class="fas fa-times"></i> Ingrese una dirección de origen</span>'
        )
      : $("#origen_help").html(
          '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
        );

    destino == "" || destino == null
      ? $("#destino_help").html(
          '<span style="color:red;"><i class="fas fa-times"></i> Ingrese una dirección de destino</span>'
        )
      : $("#destino_help").html(
          '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
        );

    tipo == "" || tipo == null
      ? $("#tipo_help").html(
          '<span style="color:red;"><i class="fas fa-times"></i> Ingrese un tipo de pedido</span>'
        )
      : $("#tipo_help").html(
          '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
        );

    destinatario == "" || destinatario == null
      ? $("#destinatario_help").html(
          '<span style="color:red;"><i class="fas fa-times"></i> Ingrese el nommbre completo del destinatario</span>'
        )
      : $("#destinatario_help").html(
          '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
        );

    $.ajax({
      url: "server/http_request/new_order.php",
      type: "POST",
      dataType: "json",
      data: {
        origen: origen,
        depto_origen: depto_origen,
        destino: destino,
        depto_destino: depto_destino,
        tipo: tipo,
        destinatario: destinatario,
        descripcion: descripcion
      },
      success: function(data) {
        if (data.success == false) {
          console.log("error, complete todos los campos");
        } else {
          console.log("todo ok");
          // enviar email a cadetes.
          // enviar notificaciones a cadetes.
          $("#modalNewOrder").modal("hide");
        }
      },
      error: function(jqXHR, textStatus, error) {
        console.log(jqXHR + "-" + textStatus + "-" + error);
      }
    });
  });
}

$("#btn-sdubmit").on("click", function() {
  var direc_origen = $("#form_newOrder")
    .find("input[name='direc_origen']")
    .val();
  var depto_origen = $("#form_newOrder")
    .find("input[name='depto_origen']")
    .val();
  var direc_destino = $("#form_newOrder")
    .find("input[name='direc_destino']")
    .val();
  var depto_destino = $("#form_newOrder")
    .find("input[name='depto_destino']")
    .val();
  var tipo = $("#form_newOrder")
    .find("select[name='tipo']")
    .val();
  var descripcion = $("#form_newOrder")
    .find("textarea[name='descripcion']")
    .val();
  var destinatario = $("#form_newOrder")
    .find("input[name='destinatario']")
    .val();

  console.log(direc_origen);
  console.log(depto_origen);
  console.log(direc_destino);
  console.log(depto_destino);
  console.log(tipo);
  console.log(descripcion);
  console.log(destinatario);

  var action = "newOrder";

  $.ajax({
    url: "server/api/api.php",
    method: "POST",
    data: {
      direc_origen,
      depto_origen,
      direc_destino,
      depto_destino,
      tipo,
      descripcion,
      destinatario
    }
  });
});

function showTarifas(){
  $.ajax({
    url: "server/http_request/show_tipos_tarifa.php",
    type: "POST",
    dataType: "json",
    success: function(data) {     
      var cuerpo = document.querySelector("#list-tarifas");      

      for (var valor of data.tarifas) {
        cuerpo.innerHTML += `<li>${valor.tipo} - ($${valor.monto})</li>`;              
      }

    },
    error: function(jqXHR, textStatus, error) {
      console.log(jqXHR + "-" + textStatus + "-" + error);
    }
  });
}

function modTarifas(){
  $('#modificar').on('click', function(e){
    e.preventDefault();
    
    var delivery = $("#tdelivery").val();
    var mudanza = $("#tmudenza").val();
    var bultog = $("#tbultog").val();
    var bultopm = $("#tbultopm").val();
    var paqueteg = $("#tpaqueteg").val();
    var paquetemp = $("#tpaquetepm").val();
    var tramite = $("#ttramite").val();
    var sobre = $("#tsobre").val();

    console.log(
      delivery +
      mudanza+
      bultog+
      bultopm+
      paqueteg+
      paquetemp+
      tramite+
      sobre
    );

  $.ajax({
    url: "server/http_request/mod_tarifas.php",
    type: "POST",
    dataType: "json",
    data: {
      sobre, 
      tramite, 
      paquetemp,  
      paqueteg, 
      bultog, 
      bultopm, 
      mudanza, 
      delivery, 
    },
    success: function(data) {     
      if(data.success)
        location.reload();
    },
    error: function(jqXHR, textStatus, error) {
      console.log(jqXHR + "-" + textStatus + "-" + error);
    }
  });

  });
}