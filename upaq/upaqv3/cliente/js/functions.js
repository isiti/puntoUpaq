// INFO: ARCHIVO FUNCTIONS.JS SE USA PARA TRABAJAR CON "JQUERY".
// NOTA: si se prefiere trabajar con JavaScript puro usar el archivo src-es6/functionsES6.js y compilarlo con babel.

"use strict";

$(document).ready(function() {
  var cuero = "";
  // Invocamos funciones.
  sideBar(); // barra lateral.
  text3d(); // efecto texto 3d
  showInfoUser(); // muestra info del usuario en -> perfil.
  seeForm(); // oculto/muestro.
  newUser(); // alta de usuario.
  editUser(); // editar usuario.
  newOrder(); // alta de pedidos.
  reloadTable(); // muestra pedidos del usuario en -> mis pedidos. (recarga la tabla)
  editOrder(); // editar orden desde mis pedidos.
  goTableOrders(); // dirige a tabla usuarios
  loadTipo(); // carga los options del select tipo.
});

// declaro mis funciones.

function loadTipo() {
  $.ajax({
    url: "server/http_request/show_tipos_tarifa.php",
    type: "POST",
    dataType: "json",
    success: function(data) {
      var cuerpo = document.querySelector("#tipo");
      cuerpo.innerHTML = "<option value=''>Seleccione una opción</option>";

      for (var valor of data.tarifas) {
        cuerpo.innerHTML += `
                <option value="${valor.tipo}">${valor.tipo} - ($${
          valor.monto
        })</option>                
            `;
      }
    },
    error: function(jqXHR, textStatus, error) {
      console.log(jqXHR + "-" + textStatus + "-" + error);
    }
  });
}

function orderClientTable(datos) {
  var cuerpo = document.querySelector("#table_user");
  cuerpo.innerHTML = "";

  for (var valor of datos.orders) {
    cuerpo.innerHTML += `
            <tr class="row-order" id="${valor.id}">
                <th>${valor.fModificacion}</th>                                
                <td>${valor.destino}</td>
                <td>${valor.cadete}</td>
                <td>${valor.status}</td>                         
            </tr>               
        `;
    showModalUser();
  }
}

// muestro solo formulario.
function seeForm() {
  $("#myform").show();

  $("#end").hide();
  $("#mytable").hide();
}

// muestro solo mensaje de cierre.
function seeEnd() {
  $("#end").show();

  $("#myform").hide();
  $("#mytable").hide();
}

// muestro solo tabla de pedidos.
function seeTable() {
  $("#mytable").show();

  $("#myform").hide();
  $("#end").hide();
}

// muestro oculto secciones.
function startHome() {
  $("#home").show();
  $("#end").hide();
}

// cambio icono en sidebar.
function sideBar() {
  $("#sidebar-action").on("click", function() {
    $("#sidebar").toggleClass("active");
  });
}

// efecto texto en 3d.
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

// doy de alta un nuevo usuario.
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

// doy de alta una nueva orden/pedido.
function newOrder() {
  $("#confirmar").on("click", e => {
    e.preventDefault();

    var origen = $("#direc_origen").val();
    var depto_origen = $("#depto_origen").val();
    var destino = $("#direc_destino").val();
    var depto_destino = $("#depto_destino").val();
    var tipo = $("#tipo").val();
    var destinatario = $("#destinatario").val();
    var descripcion = $("#descripcion").val();
    var error = 0;

    if (origen == "" || origen == null) {
      $("#origen_help").html(
        '<span style="color:red;"><i class="fas fa-times"></i> Ingrese una dirección de origen</span>'
      );
      error = +1;
    } else {
      $("#origen_help").html(
        '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
      );
      error = 0;
    }

    if (destino == "" || destino == null) {
      $("#destino_help").html(
        '<span style="color:red;"><i class="fas fa-times"></i> Ingrese una dirección de destino</span>'
      );
      error = +1;
    } else {
      $("#destino_help").html(
        '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
      );
      error = 0;
    }

    if (tipo == "" || tipo == null) {
      $("#tipo_help").html(
        '<span style="color:red;"><i class="fas fa-times"></i> Ingrese un tipo de pedido</span>'
      );
      error = +1;
    } else {
      $("#tipo_help").html(
        '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
      );
      error = 0;
    }

    if (destinatario == "" || destinatario == null) {
      $("#destinatario_help").html(
        '<span style="color:red;"><i class="fas fa-times"></i> Ingrese el nommbre completo del destinatario</span>'
      );
      error = +1;
    } else {
      $("#destinatario_help").html(
        '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
      );
      error = 0;
    }

    if (error == 0) {
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
            console.log(data);
          } else {
            console.log("todo ok");
            //enviar email a cadetes.
            $.ajax({
              url: "server/http_request/send_mail.php",
              method: "POST",
              dataType: "json",
              data: { send: true },
              success: function(data) {
                console.log(data);
              },
              error: function(data) {
                console.log(data);
              }
            });

            // enviar notificaciones a cadetes.
            seeEnd();
          }
        },
        error: function(jqXHR, textStatus, error) {
          console.log(jqXHR + "-" + textStatus + "-" + error);
        }
      });
    }
  });
}

// muestro informacion del usuario.
function showInfoUser() {
  $.ajax({
    url: "server/http_request/show_info_user.php",
    type: "POST",
    dataType: "json",
    success: function(data) {
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

// muestra info de la tabla en un modal.
function showModalUser() {
  $(".row-order").on("click", function() {
    limpiarCampos();
    var id = $(this).attr("id");

    $.ajax({
      url: "server/http_request/show_modal_order.php",
      type: "GET",
      dataType: "json",
      data: { id },
      success: function(data) {
        // open modal
        $("#order-modal").modal("show");

        // info order
        $("#id_order_value").attr("value", data.id);
        $("#edit_origen").attr("value", data.origen);
        $("#edit_depto_origen").attr("value", data.depto_origen);
        $("#edit_destino").attr("value", data.destino);
        $("#edit_depto_destino").attr("value", data.depto_destino);
        $("#edit_tipo").attr("value", data.tipo);
        $("#edit_destinatario").attr("value", data.destinatario);
        $("#edit_descripcion").html(data.descripcion);

        // info cadete
        if (data.status != "sin_iniciar") {
          $(".info_cadete_modal").show();
          $("#username_cadete").html(
            data.name_cadete + " " + data.lastname_cadete
          );
          $("#email_cadete").html(data.email_cadete);
          $("#phone_cadete").html(data.phone_cadete);
          $("#btn_editar_order").hide();
        } else {
          $(".info_cadete_modal").hide();
          $("#btn_editar_order").show(); // muestro el boton para editar la orden.
        }
      },
      error: function(jqXHR, textStatus, error) {
        console.log(jqXHR + "-" + textStatus + "-" + error);
      }
    });
  });
}

// devuelvo contenido del pedido en formato de tabla.
function orderClientTable(datos) {
  var cuerpo = document.querySelector("#table_user");
  cuerpo.innerHTML = "";

  for (var valor of datos.orders) {
    cuerpo.innerHTML += `
            <tr class="row-order" id="${valor.id}">
                <th>${valor.fModificacion}</th>                                
                <td>${valor.destino}</td>
                <td>${valor.cadete}</td>
                <td>${valor.status}</td>                         
            </tr>               
        `;
    showModalUser();
  }
}

// muestro informacion de pedidos.
function showOrders() {
  $.ajax({
    url: "server/http_request/show_orders.php",
    type: "POST",
    dataType: "json",
    success: function(data) {
      orderClientTable(data);
    },
    error: function(jqXHR, textStatus, error) {
      console.log(jqXHR + "-" + textStatus + "-" + error);
    }
  });
}

// recarga las tablas.
function reloadTable() {
  setTimeout(showOrders, 1000);
  setInterval(showOrders, 5000);
}

// limpia los campos del modal de la tabla de usuarios.
function limpiarCampos() {
  // info order
  $("#edit_origen").attr("value", "");
  $("#edit_depto_origen").attr("value", "");
  $("#edit_destino").attr("value", "");
  $("#edit_depto_destino").attr("value", "");
  $("#edit_tipo").attr("value", "");
  $("#edit_destinatario").attr("value", "");
  $("#edit_descripcion").html("");
  // info cadete
  $("#username_cadete").html("");
  $("#email_cadete").html("");
  $("#phone_cadete").html("");
  // tabla
}

// editar pedidos.
function editOrder() {
  $("#btn_editar_order").on("click", e => {
    e.preventDefault();

    var id = $("#id_order_value").val();
    var origen = $("#edit_origen").val();
    var depto_origen = $("#edit_depto_origen").val();
    var destino = $("#edit_destino").val();
    var depto_destino = $("#edit_depto_destino").val();
    var destinatario = $("#edit_destinatario").val();
    var descripcion = $("#edit_descripcion").val();

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

    destinatario == "" || destinatario == null
      ? $("#destinatario_help").html(
          '<span style="color:red;"><i class="fas fa-times"></i> Ingrese el nommbre completo del destinatario</span>'
        )
      : $("#destinatario_help").html(
          '<span style="color:green;"><i class="fas fa-check"></i> gracias</span>'
        );

    $.ajax({
      url: "server/http_request/edit_order.php",
      type: "POST",
      dataType: "json",
      data: {
        id: id,
        origen: origen,
        depto_origen: depto_origen,
        destino: destino,
        depto_destino: depto_destino,
        destinatario: destinatario,
        descripcion: descripcion
      },
      success: function(data) {
        if (data.success == false) {
          console.log("error, complete todos los campos");
        } else {
          console.log("todo ok");
          // CLOSE modal
          $("#order-modal").modal("hide");
        }
      },
      error: function(jqXHR, textStatus, error) {
        console.log(jqXHR + "-" + textStatus + "-" + error);
      }
    });
  });
}

// muestro tabla de ordenes desde nav y end.
function goTableOrders() {
  $("#mis_pedidos, #aqui_pedidos").on("click", () => {
    seeTable();
  });
}
