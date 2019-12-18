<script>
    $(document).ready(function() {
            let tablaPedidos = cargarTabla();
    });

    function cargarTabla() {
        $('#tablaPedidos').DataTable({
            "destroy": true,
            "scrollX": true,
            "language": language,
            "ajax": {
                "method": "POST",
                "url": "<?php echo $serverurl; ?>ajax/listarPedidosAjax.php"
            },
            "columns": [
                {"data": "folio"},
                {"data": "fecha_pedido"},
                {"data": "cliente"},
                {"data": "cantidad"},
                {
                    "data": "total",
                    "render": function (data,type,row) {
                        return "$ " + data;
                    }
                },
                {
                    "data": "pk_pedido",
                    "render": function(data,type,row) {
                        if(row['estado'] == 'pendiente') {
                            return `<a class="btn btn-danger btn-sm pagarPedido" data-toggle="modal" data-target="#exampleModal" dataId="${row['pk_pedido']}">Pendiente</a>`
                        } else {
                            return `<button class="btn btn-success btn-sm" data-toggle="modal">&nbsp;&nbsp;Pagado&nbsp;&nbsp;</button>`
                        }
                    }
                }
            ]
        });
    }
</script>