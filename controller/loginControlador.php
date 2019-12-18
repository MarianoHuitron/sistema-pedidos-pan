<?php
    if($peticionAjax) {
        require_once "../model/loginModelo.php";
    } else {
        require_once "./model/loginModelo.php";
    }

    class loginControlador extends loginModelo {
        public function iniciar_sesion_controlador() {
            $usuario = mainModel::limpiar_cadena($_POST['Usuario']);
            $clave = mainModel::limpiar_cadena($_POST['Clave']);
            $ruta = "";

            $clave = mainModel::encryption($clave);

            $dataLogin = [
                "Usuario"=>$usuario,
                "Clave"=>$clave
            ];

            $login = loginModelo::iniciar_sesion_modelo($dataLogin);

            if($login->rowCount()==1) {
                $row = $login->fetch();
                session_start(['name'=>'SPSJ']);
                $_SESSION['usuario_spsj']=$row['nombre_usuario'];
                $_SESSION['token_spsj']=md5(uniqid(mt_rand(),true));
                $_SESSION['clave_spsj']=mainModel::encryption($row['pk_usuario']);
                $ser = mainModel::serverURLMain();
                $url = $ser."home/";
                return '<script>
                    window.location.href="'.$url.'"
                </script>';
            } else {
                $alerta = [
                    "Alerta"=>"simple",
                    "Titulo"=>"Ups!",
                    "Texto"=>"El nombre de usuario y/0 contraseña no son correctos o la cuenta no existe",
                    "Tipo"=>"error"
                ];
            }
            return mainModel::sweet_alert($alerta,$ruta);
        }

        public function forzar_cierre_sesion_controlador() {
            $ser = mainModel::serverURLMain();
            session_destroy();
            return header("Location: ".$ser."login/");
        }

        public function cerrar_sesion_controlador() {
            session_start(['name'=>'SPSJ']);
            $token = mainModel::decryption($_GET['Token']);
            $datos = [
                "Usuario"=>$_SESSION['usuario_spsj'],
                "Token_S"=>$_SESSION['token_spsj'],
                "Token"=>$token
            ];
            return loginModelo::cerrar_sesion_modelo($datos);
        }
    }