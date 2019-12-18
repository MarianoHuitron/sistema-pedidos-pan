<?php
    if ($peticionAjax) {
        require_once "../core/mainModel.php";
    } else {
        require_once "./core/mainModel.php";
    }
    class pedidoModelo extends mainModel {
        protected function guardar_pedido_modelo($datos) {
            $query = mainModel::conectar()->prepare("INSERT INTO pedidos (folio,fk_cliente,fecha_pedido,estado) VALUES (:Folio, :Cliente, :Fecha, :Estado)");
            $query->bindParam(":Folio",$datos['Folio']);
            $query->bindParam(":Cliente",$datos['Cliente']);
            $query->bindParam(":Fecha",$datos['Fecha']);
            $query->bindParam(":Estado",$datos['Estado']);
            $query->execute();
            return $query;
        }

        protected function actualizar_pedido_modelo($datos) {
            $query = mainModel::conectar()->prepare("UPDATE pedidos SET cantidad=:Cantidad, total=:Total WHERE pk_pedido=:Clave");
            $query->bindParam(":Cantidad",$datos['Cantidad']);
            $query->bindParam(":Total",$datos['Total']);
            $query->bindParam(":Clave",$datos['Clave']);
            $query->execute();
            return $query;
        }

        protected function guardar_detalle_pedido_modelo($datos) {
            $query = mainModel::conectar()->prepare("INSERT INTO detalle_pedido(fk_pedido,fk_pan,cantidad,subtotal) VALUES (:Pedido,:Pan,:Cantidad,:Subtotal)");
            $query->bindParam(":Pedido",$datos['Pedido']);
            $query->bindParam(":Pan",$datos['Pan']);
            $query->bindParam(":Cantidad",$datos['Cantidad']);
            $query->bindParam(":Subtotal",$datos['Subtotal']);
            $query->execute();
            return $query;
        }
    }