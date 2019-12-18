let language = {
    "emptyTable":			"No hay datos disponibles en la tabla.",
    "info":		   		"Del _START_ al _END_ de _TOTAL_ ",
    "infoEmpty":			"Mostrando 0 registros de un total de 0.",
    "infoFiltered":			"(filtrados de un total de _MAX_ registros)",
    "infoPostFix":			"(actualizados)",
    "lengthMenu":			"Mostrar _MENU_ registros",
    "loadingRecords":		"Cargando...",
    "processing":			"Procesando...",
    "search":			"Buscar:",
    "searchPlaceholder":		"Dato para buscar",
    "zeroRecords":			"No se han encontrado coincidencias.",
    "paginate": {
        "first":			"Primera",
        "last":				"Última",
        "next":				"Siguiente",
        "previous":			"Anterior"
    },
    "aria": {
        "sortAscending":	"Ordenación ascendente",
        "sortDescending":	"Ordenación descendente"
    }
};

$(document).ready(function(e) {

    let width = window.innerWidth;
    console.log(width)
    if(width<1044) {
        $('.pagina').addClass('no-menu');
        $('.container').addClass('no-menu');
    }
    // $(window).resize(function() {
    //         let ancho = $(window).width();
    //         if(ancho<890) {
    //             $('.pagina').addClass('no-menu');
    //             $('.container').addClass('no-menu');
    //         } else {
    //             $('.pagina').removeClass('no-menu');
    //             $('.container').removeClass('no-menu');
    //         }
    //         console.log(ancho);
    //         // $('.pagina').toggleClass('no-menu');
    //         // $('.container').toggleClass('no-menu');
        
    // })
   
    $('.bars').on('click', function() {
        $('.pagina').toggleClass('no-menu');
        $('.container').toggleClass('no-menu');
    });  
    // funcion para el boton del menu lateral
    

    
    $('.FormularioAjax').submit(function(e){
        e.preventDefault();
        var form=$(this);

        var tipo=form.attr('data-form');
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var respuesta=form.children('.RespuestaAjax');

        var msjError="<script>swal('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
        var formdata = new FormData(this);
 

        var textoAlerta;
        if(tipo==="save"){
            textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
        }else if(tipo==="delete"){
            textoAlerta="Los datos serán eliminados completamente del sistema";
        }else if(tipo==="update"){
        	textoAlerta="Los datos del sistema serán actualizados";
        }else{
            textoAlerta="Quieres realizar la operación solicitada";
        }


        swal({
            title: "¿Estás seguro?",   
            text: textoAlerta,   
            icon: "info",   
            buttons: {
                cancel: "Cancelar",
                Aceptar: true
            },
            dangerMode: true
        }).then(function (value) {
           if(value) {
            $.ajax({
                type: metodo,
                url: accion,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                xhr: function(){
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
                        	respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                      	}else{
                      		respuesta.html('<p class="text-center"></p>');
                      	}
                      }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    respuesta.html(data);
                },
                error: function() {
                    respuesta.html(msjError);
                }
            });
           }
            return false;
        });
    });

   $(document).on('click','.borrar', function(e) {
       e.preventDefault();
       let form = $(this).parent();
       var tipo=form.attr('data-form');
       var accion=form.attr('action');
       var metodo=form.attr('method');
       let codigoDelete = $(form)[0][0].value;
       var respuesta=form.children('.RespuestaAjax');

       var msjError="<script>swal('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
      
       var textoAlerta;
       if(tipo==="save"){
           textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
       }else if(tipo==="delete"){
           textoAlerta="Los datos serán eliminados completamente del sistema";
       }else if(tipo==="update"){
           textoAlerta="Los datos del sistema serán actualizados";
       }else{
           textoAlerta="Quieres realizar la operación solicitada";
       }

       swal({
            title: "¿Estás seguro?",   
            text: textoAlerta,   
            icon: "info",   
            buttons: {
                cancel: "Cancelar",
                Aceptar: true
            },
        dangerMode: true
        }).then(function (value) {
            if(value) {
                $.post(accion,{codigoDelete},function(response) {
                    respuesta.html(response);
                })
            }
            return false;
        });
    })

    $("#exampleModal").on('hidden.bs.modal', function () {
        
        $()
    });

});


// agrega el detalle de pedido
$(document).on('click','.panMenu', function () {
    let seleccion = $(this) ;
    swal("¿Cuántas piezas?", {
        content: {
            element: "input",
            attributes: {
                type: "number"
            },
        },
        buttons: ["Cancelar",true],
      })
      .then((value) => {
        if(isNaN(value)) {
            swal(`Formato no valido!`,"","warning");
        } else {
            if(value >= 1) {
                if(value % 1 == 0) {
                    let clave = seleccion.attr('value');
                    let url = seleccion.attr('action');
                    // let pan = seleccion.attr('data-name');
                    $.post(url,{clave},function(response) {
                        // console.log(response)
                        let datos = JSON.parse(response);
                        let tmp = `
                            <tr id='filaPedido'>
                                <td dataId="${datos['pk_pan']}">${datos['nombre_pan']}</td>
                                <td>${value}</td>
                                <td>$ ${datos['precio_pan']}</td>
                                <td>$ ${(datos['precio_pan']) * value}</td>
                            </tr>
                        `;
                        $('#detallePedido').append(tmp)
                    });
                } else {
                    swal('Ups!',"Debes introducir un número entero",'warning');
                }
            }
        }
    });
});

// guardar el detalle del pedido
$(document).on('click','#guardarPedido', function() {
    if($('#filaPedido').length) {
        if($('#clientePedido').val() == "") {
            swal(`Ups!`,"Primero debes seleccionar el cliente","warning");
        } else if($('#fecha').val() == "") {
            swal(`Ups!`,"Primero debes seleccionar la fecha","warning");
        } 
        
        else {
            cliente = $('#clientePedido').val();
            let filas = $('#detallePedido tr').length;
            let fecha = $('#fecha').val();
            console.log(fecha);
            // console.log(filas)
            $.post('../ajax/pedidoAjax.php',{cliente,fecha}, function(response) {
                let folio = response;
                if(response !== "error") {
                    let regex = /(\d+)/g;
                    for(let i = 0; i<filas; i++) {
                        let row = $('#detallePedido')[0].children[i]
                        let pan = row.cells[0].getAttribute('dataId');
                        let cantidad = row.cells[1].innerText;
                        let subtotal = row.cells[3].innerText.match(regex);
                        subtotal = subtotal[0];
                        $.post('../ajax/detallePedidoAjax.php',{pan,cantidad,subtotal,folio}, function(response2) {
                            // console.log(response2)
                        })
                    }
                } else {
                    swal("Ups!","No se pudo registrar el pedido","error")
                }
            }).then(() =>{
                swal("Guardado","El pedido fue registrado en el sistema","success").then(()=>{
                    location.reload();
                });
            });
        }
    }
    
});

   // mostrar datos en campos de formulario de pagos
$(document).on('click','.pagarPedido',function() {
    let campoFolio = $('#folio');
    let campoCliente = $('#cliente');
    let campoSubtotal = $('#subtotal');
    let campoDevueltas = $('#devueltas');
    let campoDescuento = $('#descuento');
    let campoCodigoPedido = $('#codigoPedido');
    let campoTotal = $('#total');
    let codigoPedido = $(this).attr('dataid');

    campoDevueltas.val('');
    campoDescuento.val('');
    campoTotal.val('');

    $.post('../ajax/pedidoAjax.php',{codigoPedido}, function(response) {
        let datos = JSON.parse(response);
        // console.log(datos['folio']);
        campoCodigoPedido.val(codigoPedido);
        campoFolio.val(datos['folio'])
        campoCliente.val(datos['nombre_negocio'])
        campoCliente.attr('value',datos['fk_cliente']);
        campoSubtotal.val("$"+datos['total']);
        
    });

    $('#exampleModal').on('shown.bs.modal', function () {
     
    });
})

$(document).on('click','#btnSubmit', function() {
    let campoFolio = $('#folio').val();
    let campoCliente = $('#cliente').val();
    let campoSubtotal = $('#subtotal').val().replace("$","");
    let campoDevueltas = $('#devueltas').val();
    let campoDescuento = $('#descuento').val().replace("$","");
    let campoCodigoPedido = $('#codigoPedido').val();
    let campoTotal = $('#total').val().replace("$","");
    // let codigoPedido = $(this).attr('dataid');
    let codigoCliente = $('#cliente').attr('value');

    if(campoDevueltas == "" || campoDescuento == "" || campoTotal == "") {
        swal('Ups!','Todos los campos son necesarios','error');
    } else {
        $.post('../ajax/cobroAjax.php',{campoFolio,campoSubtotal,campoDevueltas,campoDescuento,campoTotal,campoCodigoPedido,codigoCliente}, function(response) {
            if(response == 'ok') {
                swal('Guardado',"El cobro fue registrado con éxito en el sistema", 'success');
                $('#exampleModal').modal('hide');
                cargarTabla();
            } else {
                swal('Ups!','No se pudo registrar el pago','error');
            }
        });
    }

   
   
})

