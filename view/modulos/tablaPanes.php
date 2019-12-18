<script>
    $(document).ready(function() {
            let tablaPanes = cargarTabla();
    });

    function cargarTabla() {
        $('#tablaPanes').DataTable({
            "destroy": true,
            "scrollX": true,
            "language": language,
            "ajax": {
                "method": "POST",
                "url": "<?php echo $serverurl; ?>ajax/listarPanesAjax.php"
            },
            "columns": [
                {"data": "nombre_pan"},
                {
                    "data": "precio_pan",
                    "render": function (data,type,row) {
                        return "$ "+data;
                    }
                },
                {"data": "tipo_pan"},
                {
                    "data": "imagen",
                    "render": function(data,type,row) {
                        let data_n = data.split("/");
                        return '<center><img src="<?php echo $serverurl; ?>'+data_n[1]+"/"+data_n[2]+"/"+data_n[3]+'" width="100" height="100"></center>'
                    }
                },
                {
                    "data": "pk_pan",
                    "render": function(data,type,row) {
                         return `<a href="<?php echo $serverurl; ?>editpan/${data}" class="btn btn-primary btn-sm editar" type="button"><i class="fas fa-edit"></i></a>`
                    }        
                },
                {
                    "data": "pk_pan",
                     "render": function(data,type,row) {
                         return `<form action="<?php echo $serverurl; ?>ajax/panAjax.php" method="POST" class="FormularioAjax" data-form="delete" enctype="multipart/form-data" autocomplete="off">
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