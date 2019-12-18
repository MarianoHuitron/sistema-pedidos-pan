<?php
    if ($peticionAjax) {
        require_once "../model/pedidoModelo.php";
    } else {
        require_once "./model/pedidoModelo.php";
    }

    class consultasHomeControlador extends pedidoModelo {
        public function contar_clientes_controlador() {
            $query = mainModel::ejecutar_consulta_simple("SELECT count(pk_cliente) FROM clientes");
            return $query->fetch();
        }

        public function contar_panes_controlador() {
            $query = mainModel::ejecutar_consulta_simple("SELECT count(pk_pan) FROM panes");
            return $query->fetch();
        }

        public function contar_cobros_pendientes_controlador() {
            $query = mainModel::ejecutar_consulta_simple("SELECT count(pk_pedido) FROM pedidos WHERE estado='pendiente'");
            return $query->fetch();
        }

        public function calcular_promedio_pedidos_controlador() {
            $query = mainModel::ejecutar_consulta_simple("SELECT AVG(`sum(cantidad)`) FROM vistacantidades");
            return $query->fetch();
        }

        public function mostrar_datos_grafica1_controlador($dato) {
            $query = mainModel::ejecutar_consulta_simple("SELECT c.nombre_negocio, sum(p.cantidad) as 'cantidad' From clientes c, pedidos p WHERE p.fk_cliente=c.pk_cliente GROUP bY c.nombre_negocio ORDER BY cantidad DESC LIMIT 10");
            return$query->fetchAll();
        }

        public function mostrar_nombre_negocios_controlador() {
            $query = mainModel::ejecutar_consulta_simple("SELECT c.nombre_negocio from pedidos p, clientes c WHERE p.fk_cliente=c.pk_cliente group by c.nombre_negocio ORDER BY cantidad DESC LIMIT 10");
            return $query->fetchAll();
        }
    }
