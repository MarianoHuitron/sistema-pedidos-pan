<?php
    if ($peticionAjax) {
        require_once "../core/mainModel.php";
    } else {
        require_once "./core/mainModel.php";
    }
    class usuarioModelo extends mainModel {
        protected function agregar_usuario_modelo($data) {
            $query = mainModel::conectar()->prepare("INSERT INTO usuarios(nombre_usuario,pass) VALUES(:Usuario,:Clave)");
            $query->bindParam(":Usuario",$data['Usuario']);
            $query->bindParam(":Clave",$data['Clave']);
            $query->execute();
            return $query;
        }

        protected function eliminar_usuario_modelo($data) {
            $query = mainModel::conectar()->prepare("DELETE FROM usuarios WHERE pk_usuario=:Codigo ");
            $query->bindParam(":Codigo",$data);
            $query->execute();
            return $query;
        }

        protected function actualizar_usuario_modelo($datos) {
            $query = mainModel::conectar()->prepare("UPDATE usuarios SET nombre_usuario=:Nombre, pass=:Password WHERE pk_usuario=:Codigo");
            $query->bindParam(":Nombre",$datos['Nombre']);
            $query->bindParam(":Password",$datos['Password']);
            $query->bindParam(":Codigo",$datos['Codigo']);
            $query->execute();
            return $query;
        }
    }