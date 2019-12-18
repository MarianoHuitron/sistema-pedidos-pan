<script>
    $(document).ready(function() {
            let tablaUsuarios = cargarTabla();
    });

    function cargarTabla() {
        $('#tablaUsuarios').DataTable({
            "destroy": true,
            "scrollX": true,
            "language": language,
            "ajax": {
                "method": "POST",
                "url": "<?php echo $serverurl; ?>ajax/listarUsuariosAjax.php"
            },
            "columns": [
                {"data": "pk_usuario"},
                {"data": "nombre_usuario"},
                {
                    "data": "pk_usuario",
                    "render": function(data,type,row) {
                         return `<a href="<?php echo $serverurl; ?>editusuario/${data}" class="btn btn-primary btn-sm editar" type="button"><i class="fas fa-edit"></i></a>`
                    }        
                },
                {
                    "data": "pk_usuario",
                     "render": function(data,type,row) {
                         return `<form action="<?php echo $serverurl; ?>ajax/usuarioAjax.php" method="POST" class="FormularioAjax" data-form="delete" enctype="multipart/form-data" autocomplete="off">
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