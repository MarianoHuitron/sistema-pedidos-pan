<?php
    if($peticionAjax) {
        require_once "../core/mainModel.php";
    } else {
        require_once "./core/mainModel.php";
    }

    class loginModelo extends mainModel {
        protected function iniciar_sesion_modelo($datos) {
            $query = mainModel::conectar()->prepare("SELECT * FROM usuarios WHERE nombre_usuario=:Usuario AND pass=:Clave");
            $query->bindParam(":Usuario",$datos['Usuario']);
            $query->bindParam(":Clave",$datos['Clave']);
            $query->execute();
            return $query;
        } 

        protected function cerrar_sesion_modelo($datos) {
            if ($datos['Usuario'] != "" && $datos['Token_S'] == $datos['Token']) {
                session_unset();
                session_destroy();
                $respuesta="true";
            } else {
                $respuesta = "false";
            }
            return $respuesta;
            
        }
    }