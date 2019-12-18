<script>
    $(document).ready(function() {
            let tablaClientes = cargarTabla();
    });

    function cargarTabla() {
        $('#tablaClientes').DataTable({
            "destroy": true,
            "scrollX": true,
            "language": language,
            "ajax": {
                "method": "POST",
                "url": "<?php echo $serverurl; ?>ajax/listarClientesAjax.php"
            },
            "columns": [
                {"data": "nombre_negocio"},
                {"data": "nombre_encargado"},
                {"data": "telefono"},
                {"data": "direccion"},
                {"data": "localidad"},
                {
                    "data": "pk_cliente",
                    "render": function(data,type,row) {
                         return `<a href="<?php echo $serverurl; ?>editcliente/${data}" class="btn btn-primary btn-sm editar" type="button"><i class="fas fa-edit"></i></a>`
                    }        
                },
                {
                    "data": "pk_cliente",
                     "render": function(data,type,row) {
                         return `<form action="<?php echo $serverurl; ?>ajax/clienteAjax.php" method="POST" class="FormularioAjax" data-form="delete" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="codigo-del" value="${data}">
                            <a class="btn btn-danger btn-sm borrar" type="submit" value=''><i class="fas fa-trash-alt"></i></a>
                            <div class="RespuestaAjax"></div>
                        </form>`
                     }
                }
            ]
        });
    }
</script>