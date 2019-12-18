<?php
    if($peticionAjax) {
        require_once  "../core/configAPP.php";
        require_once "../core/configGeneral.php";
    } else {
        require_once  "./core/configAPP.php";
        require_once "./core/configGeneral.php";
    }

    class mainModel {
        
        // conexion a la base de datos
        protected function conectar() {
            $enlace = new PDO(SGBD,USER,PASS);
            return $enlace;
        }

        // sirve para cualquier tipo de consulta simple
        protected function ejecutar_consulta_simple($consulta) {
            $respuesta = self::conectar()->prepare($consulta);
            $respuesta->execute();
            return $respuesta;
        }

        // funcion para encriptar contraseñas
        public function encryption($string) {
            $output = FALSE;
            $key = hash('sha256', SECRET_KEY);
            $iv = substr(hash('sha256', SECRET_IV), 0, 16);
            $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
            $output = base64_encode($output);
            return $output;
        }

        // funcion para desencriptar
        protected function decryption($string) {
            $key = hash('sha256', SECRET_KEY);
            $iv = substr(hash('sha256', SECRET_IV), 0, 16);
            $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
            return $output;
        }

        // función para limpiear las cadenas escritas en los campos de texto
        protected function limpiar_cadena($cadena) {
            $cadena = trim($cadena);
            $cadena = stripslashes($cadena);
            $cadena = str_ireplace("<script>", "", $cadena);
            $cadena = str_ireplace("</script>", "", $cadena);
            $cadena = str_ireplace("<script src>", "", $cadena);
            $cadena = str_ireplace("<script type=>", "", $cadena);
            $cadena = str_ireplace("SELECT * FROM", "", $cadena);
            $cadena = str_ireplace("DELETE FROM", "", $cadena);
            $cadena = str_ireplace("INSERT INTO", "", $cadena);
            $cadena = str_ireplace("--", "", $cadena);
            $cadena = str_ireplace("^", "", $cadena);
            $cadena = str_ireplace("[", "", $cadena);
            $cadena = str_ireplace("]", "", $cadena);
            $cadena = str_ireplace("==", "", $cadena);
            $cadena = str_ireplace(";", "", $cadena);
            return $cadena;
        }

        // retorna las alertas
        protected function sweet_alert($datos,$ruta) {
            if($datos['Alerta'] == "simple") {
                $alerta = "
                    <script>
                        swal(
                            '".$datos['Titulo']."',
                            '".$datos['Texto']."', 
                            '".$datos['Tipo']."'   
                        )
                    </script>
                ";
            } else if($datos['Alerta'] == "recargar") {
                $alerta = "
                    <script>
                       swal({
                           title: '".$datos['Titulo']."',
                           text: '".$datos['Texto']."',
                           icon: '".$datos['Tipo']."',
                           confirmButtonText: 'Aceptar'
                       }).then(function () {
                           location.reload();
                       });
                    </script>
                ";
            } else if($datos['Alerta'] == "limpiar") {
                if($ruta == "") {
                    $alerta = "
                    <script>
                       swal({
                           title: '".$datos['Titulo']."',
                           text: '".$datos['Texto']."',
                           icon: '".$datos['Tipo']."',
                           confirmButtonText: 'Aceptar'
                       }).then(function() {
                           cargarTabla();
                       })
                    </script>
                ";
                } else {
                    $alerta = "
                    <script>
                       swal({
                           title: '".$datos['Titulo']."',
                           text: '".$datos['Texto']."',
                           icon: '".$datos['Tipo']."',
                           confirmButtonText: 'Aceptar'
                       }).then(function () {
                           window.location.href='".$ruta."'
                       });
                    </script>
                ";
                }
                
            }
            return $alerta;
        }

        protected function generar_codigo_aleatorio($letra,$longitud,$num) {
            for($i = 1; $i <= $longitud; $i++) {
                $numero = rand(0,9);
                $letra.=$numero;
            }
            return $letra.$num;
        }

        public function serverURLMain() {
            $url = new serverUrl();
            $serverurl = $url->SERVERURL();
            return $serverurl;
        }
        
    }