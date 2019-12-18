<?php
    if ($peticionAjax) {
        require_once "../core/mainModel.php";
    } else {
        require_once "./core/mainModel.php";
    }

    class panModelo extends mainModel {
        protected function agregar_pan_modelo($data) {
            $query = mainModel::conectar()->prepare("INSERT INTO panes(nombre_pan,precio_pan,imagen,tipo_pan) VALUES(:Pan,:Precio,:Imagen,:Tipo) ");
            $query->bindParam(":Pan",$data['Pan']);
            $query->bindParam(":Precio",$data['Precio']);
            $query->bindParam(":Imagen",$data['Imagen']);
            $query->bindParam(":Tipo",$data['Tipo']);
            $query->execute();
            return $query;
        }

        protected function eliminar_pan_modelo($data) {
            $query = mainModel::conectar()->prepare("DELETE FROM panes WHERE pk_pan=:Codigo");
            $query->bindParam(":Codigo",$data);
            $query->execute();
            return $query;
        }

        protected function actualizar_pan_modelo($datos,$moverImg) {
            if($moverImg==true) {
                $query = mainModel::conectar()->prepare("UPDATE panes SET nombre_pan=:Pan,precio_pan=:Precio,imagen=:Imagen,tipo_pan=:Tipo WHERE pk_pan=:Codigo");
                $query->bindParam(":Pan",$datos['Pan'], PDO::PARAM_STR);
                $query->bindParam(":Precio",$datos['Precio'], PDO::PARAM_STR);
                $query->bindParam(":Imagen",$datos['Imagen'], PDO::PARAM_STR);
                $query->bindParam(":Tipo",$datos['Tipo'], PDO::PARAM_STR);
                $query->bindParam(":Codigo",$datos['Codigo'], PDO::PARAM_STR);
                $query->execute();
                return $query;
            } else {
                $query = mainModel::conectar()->prepare("UPDATE panes SET nombre_pan=:Pan,precio_pan=:Precio, tipo_pan=:Tipo WHERE pk_pan=:Codigo");
                $query->bindParam(":Pan",$datos['Pan'], PDO::PARAM_STR);
                $query->bindParam(":Precio",$datos['Precio'], PDO::PARAM_STR);
                $query->bindParam(":Tipo",$datos['Tipo'], PDO::PARAM_STR);
                $query->bindParam(":Codigo",$datos['Codigo'], PDO::PARAM_STR);
                $query->execute();
                return $query;
            }
            
        }
    }