'use strict'

// carga del doc.
$(document).ready(function () {
	// Invocamos funciones.
    sideBar(); // cambia icono en la barra lateral.    
    if(document.querySelector('#isDow').value =='dow' ){
        changeSection('pedidos-dow');// muesto el inicio al ingresar al cms como user dow.
    }else{
        
        changeSection('inicio'); // muesto el inicio al ingresar al cms.
    }
    goSecion(); // me muevo entre secciones.
    showTotalUsers('user'); // total de usuarios.    
    showTotalUsers('cadete'); // total de cadetes.
    showTotalUsers('admin'); // total de administradores.    
    showTotalOrders('sin_iniciar', 'orders'); // total pedidos sin iniciar.
    showTotalOrders('en_proceso', 'orders');  // total pedidos en proceso.
    showTotalOrders('completado', 'orders'); // total pedidos completados.
    showTotalOrders('sin_iniciar', 'dow'); // total pedidos sin iniciar.
    showTotalOrders('en_proceso', 'dow');  // total pedidos en proceso.
    showTotalOrders('completado', 'dow'); // total pedidos completados.
    showTableUsers(); // muestro tabla users.  
    showTableCadetes(); // muestro tabla cadetes.  
    showTablePedidos('dow', 'tbody-table-pedidos-dow'); // muestro table (DOW) pedidos.
    showTablePedidos('orders', 'tbody-table-pedidos');
    showTableTarifas(); // muestro tabla tarifas
    completeSelectModal(); // completo el select del modal de nuevo pedido.
    newOrder('dow', 'form_new_order_dow'); // alta de un nuevo pedido desde CMS.
    newOrder('orders', 'form_new_order'); // alta pedido normal.
    newRate(); // alta de tarifa
});

// declaro mis funciones.
function sideBar(){
    $('#sidebar-action').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
}

// oculto todas las secciones.
function hideAll(){
    $('#sec-inicio').hide();
    $('#sec-cadetes').hide();
    $('#sec-clientes').hide();
    $('#sec-pedidos').hide();
    $('#sec-pedidos-dow').hide();
    $('#sec-tarifas').hide();
}

// elijo que mostrar.
function OnlyShow(hideFunction, ...pages){
    var hideall = hideFunction();
    for (var i = 0; i < pages.length; i++) {
      $("#"+pages[i]).show();
    }
}

// elijo que seccion mostror
function changeSection(section){
    switch (section) {
        case 'inicio': OnlyShow(hideAll, 'sec-inicio'); break;       
        case 'cadetes': OnlyShow(hideAll, 'sec-cadetes'); break; 
        case 'clientes': OnlyShow(hideAll, 'sec-clientes'); break;
        case 'pedidos': OnlyShow(hideAll, 'sec-pedidos'); break;
        case 'pedidos-dow': OnlyShow(hideAll, 'sec-pedidos-dow'); break;
        case 'tarifas': OnlyShow(hideAll, 'sec-tarifas'); break;
        default: OnlyShow(hideAll, 'sec-inicio'); break;
    }
}

// voy a sección
function goSecion(){
    document.getElementById('goInicio').onclick = ()=>{ changeSection('inicio'); };
    document.getElementById('goPedidos').onclick = ()=>{ changeSection('pedidos'); };
    document.getElementById('goPedidosDow').onclick = ()=>{ changeSection('pedidos-dow'); };
    document.getElementById('goCadetes').onclick = ()=>{ changeSection('cadetes'); };
    document.getElementById('goClientes').onclick = ()=>{ changeSection('clientes'); };
    document.getElementById('goTarifas').onclick = ()=>{ changeSection('tarifas'); };
    
}

// muestro total de usuarios
function showTotalUsers(type){
    fetch('server/http_request/total_user.php?type='+type)
        .then(resp => resp.json())
        .then(resp => {               
            if(type == 'cadete') document.getElementById('total_cadetes').innerHTML = resp;
            if(type == 'user') document.getElementById('total_clientes').innerHTML = resp;
            if(type == 'admin') document.getElementById('total_admin').innerHTML = resp;
        })
        .catch(error => {
            console.log('ERROR en petición http de total_user.php', error);
        });
}

// muestro total de pedidos
function showTotalOrders(status, table){
    fetch('server/http_request/total_orders.php?status='+status+'&table='+table)
        .then(resp => resp.json())
        .then(resp => {
            if(table == 'orders'){
                if(status == 'sin_iniciar') document.getElementById('total_pedidos_sin_iniciar').innerHTML = resp;
                if(status == 'en_proceso') document.getElementById('total_pedidos_en_proceso').innerHTML = resp;
                if(status == 'completado') document.getElementById('total_pedidos_completados').innerHTML = resp;
            }

            if(table == 'dow'){
                if(status == 'sin_iniciar') document.getElementById('total_pedidos_sin_iniciar_dow').innerHTML = resp;
                if(status == 'en_proceso') document.getElementById('total_pedidos_en_proceso_dow').innerHTML = resp;
                if(status == 'completado') document.getElementById('total_pedidos_completados_dow').innerHTML = resp;
            }
        })
        .catch(error => {
            console.log('ERROR en petición http de total_orders.php', error);
        });
}

// muestro usuarios(clientes) en tabla
function showTableUsers(){
    fetch('server/http_request/show_table_users.php')
        .then(resp => resp.json())
        .then(resp => {                      
            for(var valor of resp){            
                document.querySelector('#tbody-table-users').innerHTML += `
                    <tr class="data-table">           
                        <td>${valor.id}</td>                 
                        <td>${valor.name} ${valor.lastname}</td>                        
                        <td>${valor.email}</td>
                        <td>${valor.phone}</td>
                        <td>${valor.fCreacion}</td>
                        <td><button id="edit_cliete_${valor.id}" class="btn btn-dark btn-acreditar"><i class="fas fa-check"></i></button></td>
                        <td><button id="delete_cliete_${valor.id}" class="btn btn-dark btn-cancelar"><i class="fas fa-times"></i></button></td>
                    </tr>  
                `
            }  
        })
        .catch(error => {
            console.log('ERROR en petición http de show_table_users.php', error);
        });
}

// muestro cadetes en tabla
function showTableCadetes(){
    fetch('server/http_request/show_table_cadetes.php')
        .then(resp => resp.json())
        .then(resp => {                       
            for(var valor of resp){            
                document.querySelector('#tbody-table-cadetes').innerHTML += `
                    <tr class="data-table">         
                        <td>${valor.id}</td>                   
                        <td>${valor.name} ${valor.lastname}</td>                        
                        <td>${valor.email}</td>
                        <td>${valor.phone}</td>
                        <td>${valor.fCreacion}</td>
                        <td><button id="edit_cadete_${valor.id}" class="btn btn-dark btn-acreditar"><i class="fas fa-check"></i></button></td>
                        <td><button id="delete_cadete_${valor.id}" class="btn btn-dark btn-cancelar"><i class="fas fa-times"></i></button></td>                               
                    </tr>  
                `
            }  
        })
        .catch(error => {
            console.log('ERROR en petición http de show_table_users.php', error);
        });
}

// muestro pedidos en tabla
function showTablePedidos(tablaDb, idTablaHtml ){
    fetch('server/http_request/show_table_pedidos.php?tablaDb='+tablaDb)
        .then(resp => resp.json())
        .then(resp => {             
            console.log(resp); 
            let data;        
            for(var valor of resp){     
                if(tablaDb == 'dow'){       
                    data += `
                        <tr class="data-table-dow validado-${valor.validado}" id="${valor.id}" data-status="${valor.status}" data-toggle="modal" data-target="#openOrderDow">  
                            <td>${valor.n_solicitante}</td> 
                            <td>${valor.solicitante}</td> 
                            <td>${valor.tipo}</td>                          
                            <td>${valor.aprobador}</td>
                            <td>${valor.proveedor}</td>                        
                            <td>${valor.origen}</td>                        
                            <td>${valor.destino}</td>                        
                            <td>${valor.fCreacion}</td>  
                            <td>${valor.prioridad}</td>   
                            <td class="${valor.status}">${valor.status}</td> 
                                                                   
                        </tr>  
                    `                    
                    // <td class="edit_dow" id="edit_dow"><i class="fas fa-edit"></i></td> 
                    // <td class="delete_dow" id="delete_dow"><i class="fas fa-times"></i></td>     
                }
                if(tablaDb == 'orders'){
                    data += `
                        <tr class="data-table" id="${valor.id}" data-status="${valor.status}" data-toggle="modal" data-target="#openOrder">  
                            <td>${valor.id}</td> 
                            <td>${valor.user}</td> 
                            <td>${valor.destinatario}</td>                          
                            <td>${valor.origen} ${valor.depto_origen}</td>
                            <td>${valor.destino} ${valor.depto_destino}</td>                        
                            <td>${valor.tipo}</td>
                            <td>Monto</td>
                            <td>${valor.cadete}</td>                        
                            <td>${valor.fCreacion}</td> 
                            <td class="${valor.status}">${valor.status}</td>                                                   
                        </tr>  
                    `                      
                }
            }  

            $('#'+idTablaHtml).html(data);   
            
            showOrderInfo();        
            
            $('#btn_aprobar_dow').on('click', function(){
                validarOrderDow('y');
            });

            $('#btn_desaprobar_dow').on('click', function(){
                validarOrderDow('n');
            });

            $('#btn_eliminar_dow').on('click', function(){
                eliminarOrderDow();
            });
           
        })
        .catch(error => {
            console.log('ERROR en petición http de show_table_pedidos.php', error);
        });
}

function showOrderInfo(){

    $('.data-table-dow').on('click', function(){        
        var status = $(this).data('status'); 
        let id = $(this).attr('id');

        $('#save-id-in-modal').attr('value', id)

        fetch("server/http_request/show_table_pedidos_info.php?tabla=dow&id="+ id)
        .then(resp => resp.json())
        .then(resp => {             
            for (var valor of resp['orders']) {
                $('#show-nsolicitante-dow').html(valor.n_solicitante);
                $('#show-solicitante-dow').html(valor.solicitante);
                $('#show-aprobador-dow').html(valor.aprobador);
                $('#show-proveedor-dow').html(valor.proveedor);
                $('#show-tipo-dow').html(valor.tipo);
                $('#show-prioridad-dow').html(valor.prioridad);
                $('#show-detalle-dow').html(valor.detalle);
                $('#show-contacto-dow').html(valor.contacto);
                $('#show-origen-dow').html(valor.origen);
                $('#show-destino-dow').html(valor.destino);
                $('#show-fCreacion-dow').html(valor.fCreacion);
                $('#show-fModificacion-dow').html(valor.fModificacion);
                $('#show-status-dow').html(valor.status);

                if(valor.validado == 'y') { 
                    $('#btn_aprobar_dow').hide();
                    $('#btn_desaprobar_dow').show();
                } else { 
                    $('#btn_aprobar_dow').show();
                    $('#btn_desaprobar_dow').hide();
                }
            }      

            
                        
            for(var valor of resp['cadete']){   
                if(status != 'sin_iniciar') {
                    $('#show-cadete-name-dow').html(valor.lastname + ', ' + valor.name);
                    $('#show-cadete-contacto-dow').html(valor.phone);
                    $('#show-cadete-email-dow').html(valor.email);
                } else {
                    $('#show-cadete-name-dow').html('');
                    $('#show-cadete-contacto-dow').html('');
                    $('#show-cadete-email-dow').html('');
                }  
                
            }
            
        })
        .catch(error => {
            console.log('ERROR en petición http de show_table_pedidos_info.php', error);
        });
    });

    $('.data-table').on('click', function(){
        var status = $(this).data('status');        

        fetch("server/http_request/show_table_pedidos_info.php?tabla=orders&id="+$(this).attr('id'))
        .then(resp => resp.json())
        .then(resp => {             
            for (var valor of resp['orders']) {
                $('#show-id-order').html(valor.id);
                $('#show-user-order').html(valor.user);
                $('#show-destinatario-order').html(valor.destinatario);
                $('#show-tipo-order').html(valor.tipo);
                $('#show-origen-order').html(valor.origen +' - '+ valor.depto_origen);
                $('#show-destino-order').html(valor.destino +' - '+ valor.depto_destino);
                $('#show-descripcion-order').html(valor.descripcion);
                $('#show-fCreacion-order').html(valor.fCreacion);
                $('#show-fModificacion-order').html(valor.fModificacion);
                $('#show-status-order').html(valor.status);
            }      
            
            for(var valor of resp['cadete']){  
                if(status != 'sin_iniciar') {                   
                    $('#show-cadete-name-order').html(valor.lastname + ', ' + valor.name);
                    $('#show-cadete-contacto-order').html(valor.phone);
                    $('#show-cadete-email-order').html(valor.email);
                } else {
                    $('#show-cadete-name-order').html('');
                    $('#show-cadete-contacto-order').html('');
                    $('#show-cadete-email-order').html('');
                }                
            }
        })
        .catch(error => {
            console.log('ERROR en petición http de show_table_pedidos_info.php', error);
        });
    });
}

// muestro cadetes en tabla
function showTableTarifas(){
    fetch('server/http_request/show_table_tarifas.php')
        .then(resp => resp.json())
        .then(resp => {        
            let rate;                
            for(var valor of resp){            
                rate += `
                    <tr class="data-table">         
                        <td>${valor.id}</td>                                                            
                        <td>${valor.tipo}</td>
                        <td>$${valor.monto}</td>
                        <td>$${valor.monto2}</td>
                        <td>${valor.fModificacion}</td>
                        <td><button id="${valor.id}" class="btn btn-warning btn-edit-rate" data-toggle="modal" data-target="#editRateModal"><i class="fas fa-check"></i></button></td>
                        <td><button id="${valor.id}" class="btn btn-danger btn-delete-rate"><i class="fas fa-times"></i></button></td>                               
                    </tr>  
                `;                
            }  
            $('#tbody-table-tarifas').html(rate);
            showRateInfo(); // muestro info en modal.
            editRate(); // edito el modal.
            deleteRate();
        })
        .catch(error => {
            console.log('ERROR en petición http de show_table_tarifas.php', error);
        });
}

// completa el select del modal -> alta de pedido.
function completeSelectModal(){
    fetch('server/http_request/show_table_tarifas.php')
        .then(resp => resp.json())
        .then(resp => {                                    
            for(var valor of resp){         
                document.querySelector('#tipo_viaje_modal').innerHTML += `
                   <option value="${valor.tipo}">${valor.tipo} - $${valor.monto}</option>
                `
            }  
        })
        .catch(error => {
            console.log('ERROR en petición http de show_table_tarifas.php desde completeSelectModal', error);
        });
}

// alta de pedido
function newOrder(tablaDb, idForm){    
    const form_new_order = document.querySelector('#'+idForm);

    form_new_order.addEventListener('submit', (e)=>{
        e.preventDefault();            

        let datos = new FormData(form_new_order);    
        datos.append('tablaDb', tablaDb);        

        fetch('server/http_request/new_order.php', {
            method: 'POST',
            body: datos           
        })
        .then(resp => resp.json())
        .then(data => {                        
            console.log(data);     
            location.reload();               
        })
        .catch(error => {
            console.log('ERROR en petición http de new_order.php', error);
        });    
    });      
}

// edición de tarifa.
function editRate(){
    $('.btn-edit-rate').on('click', function(){
        const form_edit_rate = document.querySelector('#form_edit_rate');

        form_edit_rate.addEventListener('submit', (e)=>{
            e.preventDefault();            

            let datos = new FormData(form_edit_rate);  
            datos.append('id', $(this).attr("id"));               

            fetch('server/http_request/update_rate.php', {
                method: 'POST',
                body: datos
            })
            .then(resp => resp.json())
            .then(data => {                        
                console.log(data);      
                location.reload();              
            })
            .catch(error => {
                console.log('ERROR en petición http de update_rate.php', error);
            });    
        });      
    });
}

// eliminar tarifa.
function deleteRate(id){
    $('.btn-delete-rate').on('click', function(){
        // let confirm = confirm('Quiere eliminar esta tarifa?');
        let id =  $(this).attr("id");          
        console.log('id: '+id);
        Swal.fire({
            title: 'Estas seguro?',
            text: "Una vez elimine la tarifa no podra recuperarse!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Deleted!',
                'La tarifa fué eliminada.',
                'success'
                )         
                console.log(id);  
                
                let active = 0;

                let deleteData = new FormData();
                deleteData.append(id, active);              

                fetch('server/http_request/delete_rate.php', {
                    method: 'POST',
                    body: deleteData
                    
                })
                .then(resp => resp.json())
                .then(data => {                                            
                    console.log(data);      
                    // location.reload();              
                })
                .catch(error => {
                    console.log('ERROR en petición http de delete_rate.php', error);
                });     
            }        
        });             
    });          
}

// muestro info actual de la tarifa en modal.
function showRateInfo(){    
    $('.btn-edit-rate').on('click', function(){
        fetch('server/http_request/show_info_rate.php?id='+$(this).attr("id"))
        .then(resp => resp.json())
        .then(data => {         
            for (let valor of data){
                $('#tipo_modal').attr('value', valor.tipo);
                $('#monto_modal').attr('value', valor.monto);
                $('#monto2_modal').attr('value', valor.monto2);                                
            }          
        })
        .catch(error => {
            console.log('ERROR en petición http de show_info_rate.php', error);
        });
    });        
}

// alta de tarifa
function newRate(){
    const form_new_rate = document.querySelector('#form_new_rate');

    form_new_rate.addEventListener('submit', (e)=>{
        e.preventDefault();            

        let datos = new FormData(form_new_rate);                  

        fetch('server/http_request/new_rate.php', {
            method: 'POST',
            body: datos
        })
        .then(resp => resp.json())
        .then(data => {                        
            console.log(data);     
            location.reload();               
        })
        .catch(error => {
            console.log('ERROR en petición http de new_rate.php', error);
        });    
    });      
}

function errorAlert(){
    Swal.fire({
        type: 'error',
        title: 'asd',
        text: 'asdasd',        
      })
}

// cambiar estado
function validarOrderDow(status){    
    let id = $('#save-id-in-modal').val();
    fetch('server/http_request/validate_order.php?validado='+status+'&id='+id)
        .then(resp => resp.json())
        .then(resp => {
            console.log(resp);                 
            (status == 'y') ? alertOk('Pedido Aprobado') : alertBad('Pedido Desaprobado');
            setTimeout(function(){
                showTablePedidos('dow', 'tbody-table-pedidos-dow');                 
            }, 2000);       
        })
        .catch(error => {
            console.log('ERROR en petición http de validate_order.php', error);
        });
}

// eliminar order(dow)
function eliminarOrderDow(){
    let id = $('#save-id-in-modal').val();
    fetch('server/http_request/delete_order.php?id='+id)
        .then(resp => resp.json())
        .then(resp => {
            console.log(resp);     
            alertOk('Pedido Eliminado')
            setTimeout(function(){
                showTablePedidos('dow', 'tbody-table-pedidos-dow');                 
            }, 2000);       
        })
        .catch(error => {
            console.log('ERROR en petición http de delete_order.php', error);
        });
}


// alert success
function alertOk(message){
    Swal.fire({
        position: 'top-end',
        type: 'success',
        title: message,
        showConfirmButton: false,
        timer: 1500
      })
}

// alert error
function alertBad(message){
    Swal.fire({
        position: 'top-end',
        type: 'error',
        title: message,
        showConfirmButton: false,
        timer: 1500
      })
}
