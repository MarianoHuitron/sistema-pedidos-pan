<?php
    if ($peticionAjax) {
        require_once "../core/mainModel.php";
    } else {
        require_once "./core/mainModel.php";
    }
    class cobroModelo extends mainModel {
        protected function guardar_cobro_modelo($datos) {
            $query = mainModel::conectar()->prepare("INSERT INTO cobros (cantidad_cobrada,fk_cliente,fk_pedido,fecha_cobro,cant_descontada,panes_devueltos) VALUES (:CantidadCobrada,:Cliente,:Pedido,:Fecha,:CantidadDescontada,:PanesDevueltos)");
            $query->bindParam(":CantidadCobrada",$datos['CantidadCobrada']);
            $query->bindParam(":Cliente",$datos['Cliente']);
            $query->bindParam(":Pedido",$datos['Pedido']);
            $query->bindParam(":Fecha",$datos['Fecha']);
            $query->bindParam(":CantidadDescontada",$datos['CantidadDescontada']);
            $query->bindParam(":PanesDevueltos",$datos['PanesDevueltos']);
            
            if ($query->execute()) {
                return 'ok';
            } else {
                return 'error';
            }
            
        }
    }