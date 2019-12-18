<?php
    class vistasModelo {
        protected function obtener_vistas_modelo($vistas) {
            $listaBlanca = ["home","nuevocliente","cliente","editcliente","pan","nuevopan","editpan","usuarios","nuevousuario","editusuario","pedidos","nuevopedido"];
            if(in_array($vistas,$listaBlanca)) {
                if(is_file("./view/contents/".$vistas."-view.php")) {
                    $contenido = "./view/contents/".$vistas."-view.php";
                } else {
                    $contenido = "login";
                }
            } elseif ($vistas == "login") {
                $contenido = "login";
            } elseif ($vistas == "index") {
                $contenido = "login";
            } else {
                $contenido = "404";
            }
            return $contenido;
        }
    }