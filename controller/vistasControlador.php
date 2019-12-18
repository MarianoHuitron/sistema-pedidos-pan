<?php
    require_once "./model/vistasModelo.php";
    class vistasControlador extends vistasModelo {

        public function obtener_plantilla_controlador() {
            return require "view/plantilla.php";
        }

        public function obtener_vistas_controlador() {
            if(isset($_GET['views'])) {
                $ruta = explode('/',$_GET['views']);
                $respuesta = vistasModelo::obtener_vistas_modelo($ruta[0]);
            } else {
                $respuesta = "login";
            }
            return $respuesta;
        }
    }