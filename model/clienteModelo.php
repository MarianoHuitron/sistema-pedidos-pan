<?php
    if ($peticionAjax) {
        require_once "../core/mainModel.php";
    } else {
        require_once "./core/mainModel.php";
    }

    class clienteModelo extends mainModel {
        // consulta para agregar cliente
        protected function agregar_cliente_modelo($datos) {
            $query = mainModel::conectar()->prepare("INSERT INTO clientes(nombre_negocio,nombre_encargado,telefono,direccion,localidad) VALUES (:Negocio,:Encargado,:Telefono,:Direccion,:Localidad)");

            $query->bindParam(":Negocio",$datos['Negocio']);
            $query->bindParam(":Encargado",$datos['Encargado']);
            $query->bindParam(":Telefono",$datos['Telefono']);
            $query->bindParam(":Direccion",$datos['Direccion']);
            $query->bindParam(":Localidad",$datos['Localidad']);
            $query->execute();
            return $query;
        }

        protected function eliminar_cliente_modelo($dato) {
            $query = mainModel::conectar()->prepare("DELETE FROM clientes WHERE pk_cliente = :pk");
            $query->bindParam(":pk",$dato);
            $query->execute();
            return $query;
        }

        protected function actualizar_cliente_modelo($datos) {
            $query = mainModel::conectar()->prepare("UPDATE clientes SET nombre_negocio=:Negocio, nombre_encargado=:Encargado,telefono=:Telefono,direccion=:Direccion,localidad=:Localidad WHERE pk_cliente=:Clave");
            $query->bindParam(":Negocio",$datos['Negocio']);
            $query->bindParam(":Encargado",$datos['Encargado']);
            $query->bindParam(":Telefono",$datos['Telefono']);
            $query->bindParam(":Direccion",$datos['Direccion']);
            $query->bindParam(":Localidad",$datos['Localidad']);
            $query->bindParam(":Clave",$datos['Clave']);
            $query->execute();
            return $query;
        }
    }
    