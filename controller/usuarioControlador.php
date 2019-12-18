<?php
    if ($peticionAjax) {
    require_once "../model/usuarioModelo.php";
    } else {
        require_once "./model/usuarioModelo.php";
    }
    class usuarioControlador extends usuarioModelo {
        public function agregar_usuario_controlador() {
            $usuario = mainModel::limpiar_cadena($_POST['usuario']);
            $password1 = mainModel::limpiar_cadena($_POST['clave1']);
            $password2 = mainModel::limpiar_cadena($_POST['clave2']);
            $ruta = "";
            if ($password1 != $password2) {
                $alerta = [
                    "Alerta"=>"simple",
                    "Titulo"=>"Ups!",
                    "Texto"=>"Las contraseñas no coinciden",
                    "Tipo"=>"error"
                ];
            } else {
                $clave = mainModel::encryption($password1);

                $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM usuarios WHERE nombre_usuario='$usuario' AND pass='$clave'");

                if ($consulta1->rowCount()>=1) {
                    $alerta = [
                        "Alerta"=>"simple",
                        "Titulo"=>"Ups!",
                        "Texto"=>"El usuario y contraseña ya se encuentran registrados",
                        "Tipo"=>"error"
                    ];
                } else {
                    $dataUser = [
                        "Usuario"=>$usuario,
                        "Clave"=>$clave
                    ];

                    $guardarUsuario = usuarioModelo::agregar_usuario_modelo($dataUser);
                    if ($guardarUsuario->rowCount()>=1) {
                        $alerta = [
                            "Alerta"=>"limpiar",
                            "Titulo"=>"Usuario registrado",
                            "Texto"=>"El usuario se registró con éxito en el sistema",
                            "Tipo"=>"success"
                        ];
                        $ser = mainModel::serverURLMain();
                        $ruta = $ser."usuarios/";
                    } else {
                        $alerta = [
                            "Alerta"=>"simple",
                            "Titulo"=>"Ups!",
                            "Texto"=>"No se pudo registrar el usuario",
                            "Tipo"=>"error"
                        ];
                        $ruta = "";
                    }
                    
                }
                
            }
            
            return mainModel::sweet_alert($alerta,$ruta);
        }

        public function mostrar_usuarios_controlador() {
            $clave = mainModel::decryption($_SESSION['clave_spsj']);
            $datos = mainModel::ejecutar_consulta_simple("SELECT pk_usuario,nombre_usuario FROM usuarios WHERE pk_usuario != '$clave'");

            $arreglo['data'] = [];

            while($row =  $datos->fetch(PDO::FETCH_ASSOC)) {
                $arreglo['data'][] = $row;
            }
            return json_encode($arreglo);
        }

        public function eliminar_usuario_controlador() {
            $codigo = $_POST['codigoDelete'];
            $eliminar = usuarioModelo::eliminar_usuario_modelo($codigo);

            if($eliminar->rowCount()>=1) {
                $alerta = [
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Usuario Eliminado",
                    "Texto"=>"El usuario fue eliminado con éxito en el sistema",
                    "Tipo"=>"success"
                ];
                $ruta = "";
            } else {
                $alerta = [
                    "Alerta"=>"simple",
                    "Titulo"=>"Ups!",
                    "Texto"=>"No se pudo eliminar el usuario",
                    "Tipo"=>"error"
                ];
                $ruta = "";
            }
            return mainModel::sweet_alert($alerta,$ruta);
        }

        public function seleccionar_usuario_controlador() {
            $usuario = explode("/",$_GET['views']);
            $res = mainModel::ejecutar_consulta_simple("SELECT * FROM usuarios WHERE pk_usuario = $usuario[1]");     
            return $res->fetch();
        }

        public function actualizar_usuario_controlador() {  
            $usuario = mainModel::limpiar_cadena($_POST['usuario']);
            $password1 = mainModel::limpiar_cadena($_POST['clave1']);
            $password2 = mainModel::limpiar_cadena($_POST['clave2']);
            $codigo = mainModel::limpiar_cadena($_POST['codigo-editar']);

            $ruta = "";
            if($password1 != $password2) {
                $alerta = [
                    "Alerta"=>"simple",
                    "Titulo"=>"Ups!",
                    "Texto"=>"Las contraseñas no coinciden",
                    "Tipo"=>"error"
                ];
            } else {
                $clave = mainModel::encryption($password1);

                $consulta1 = mainModel::ejecutar_consulta_simple("SELECT * FROM usuarios WHERE nombre_usuario='$usuario' AND pass='$clave'");

                if ($consulta1->rowCount()>=1) {
                    $alerta = [
                        "Alerta"=>"simple",
                        "Titulo"=>"Ups!",
                        "Texto"=>"Esos datos ya se encuentran registrados",
                        "Tipo"=>"error"
                    ];
                } else {
                    $dataUser = [
                        "Nombre"=>$usuario,
                        "Password"=>$clave,
                        "Codigo"=>$codigo
                    ];

                    $actualizar = usuarioModelo::actualizar_usuario_modelo($dataUser);

                    if($actualizar->rowCount()>=1) {
                        $alerta = [
                            "Alerta"=>"limpiar",
                            "Titulo"=>"Usuario Actualizado!",
                            "Texto"=>"El usuario se actualizó con éxito en el sistema",
                            "Tipo"=>"success"
                        ];
                        $ser = mainModel::serverURLMain();
                        $ruta = $ser."usuarios/";
                    } else {
                        $alerta = [
                            "Alerta"=>"simple",
                            "Titulo"=>"Ups!",
                            "Texto"=>"No se pudo actualizar el usuario",
                            "Tipo"=>"error"
                        ];
                        
                    }
                }
            }
            return mainModel::sweet_alert($alerta,$ruta);
        }
    }