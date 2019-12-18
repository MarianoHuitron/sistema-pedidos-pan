<?php
    if ($peticionAjax) {
        require_once "../model/panModelo.php";
    } else {
        require_once "./model/panModelo.php";
    }

    class panControlador extends panModelo {
        public function agregar_pan_controlador() {
            $pan = mainModel::limpiar_cadena($_POST['nombre_pan']);
            $precio = mainModel::limpiar_cadena($_POST['precio_pan']);
            $tipo = mainModel::limpiar_cadena($_POST['tipo_pan']);

            $carpeta = "panes";
            $archivo = $_FILES['imagen']['tmp_name'];
            $nombreArchivo = $_FILES['imagen']['name'];


            // echo '<script>alert("'.$nombreArchivo.'")</script>';
            // echo '<script>alert("'.$archivo.'")</script>';
            

            if($nombreArchivo==""){ $nombreArchivo="predeterminado.png"; }
            
            $imagen = "../files/".$carpeta."/".$nombreArchivo;

            // echo '<script>ert("'.$imagen.'")</script>';

           

            $dataPan = [
                "Pan"=>$pan,
                "Precio"=>$precio,
                "Imagen"=>$imagen,
                "Tipo"=>$tipo
            ];

            $guardarPan = panModelo::agregar_pan_modelo($dataPan);

            $ser = mainModel::serverURLMain();

            if($guardarPan->rowCount()>=1) {
                if($nombreArchivo=="predeterminado.png") {
                    
                    $alerta = [
                        "Alerta"=>"limpiar",
                        "Titulo"=>"Pan registrado",
                        "Texto"=>"El pan se registró con éxito en el sistema",
                        "Tipo"=>"success"
                    ];
                    $ruta = $ser."pan/";
                } else {
                    if(move_uploaded_file($archivo,$imagen)) {
                        $alerta = [
                            "Alerta"=>"limpiar",
                            "Titulo"=>"Pan registrado",
                            "Texto"=>"El pan se registró con éxito en el sistema",
                            "Tipo"=>"success"
                        ];
                        $ruta = $ser."pan/";
                    } else {
                        $query = "DELETE FROM panes WHERE nombre_pan='".$pan."' AND precio_pan='".$precio."' AND tipo_pan='".$tipo."'";
                        mainModel::ejecutar_consulta_simple($query);
                        $alerta = [
                            "Alerta"=>"simple",
                            "Titulo"=>"Pan NO registrado",
                            "Texto"=>"No se pudo registrar el pan",
                            "Tipo"=>"error"
                        ];
                        $ruta = "";
                    }
                }
            } else {
                $alerta = [
                    "Alerta"=>"simple",
                    "Titulo"=>"Pan NO registrado",
                    "Texto"=>"No se pudo registrar el pan",
                    "Tipo"=>"error"
                ];
                $ruta = "";
            }
            return mainModel::sweet_alert($alerta,$ruta);
        }

        public function mostrar_panes_controlador() {
            $datos = mainModel::ejecutar_consulta_simple("SELECT * FROM panes");

            $arreglo['data'] = [];

            while($row =  $datos->fetch(PDO::FETCH_ASSOC)) {
                $arreglo['data'][] = $row;
            }
            return json_encode($arreglo);
        }

        public function eliminar_pan_controlador() {
            $codigo = $_POST['codigoDelete'];
            $eliminar = panModelo::eliminar_pan_modelo($codigo);

            $ruta = "";
            if($eliminar->rowCount()>=1) {
                $alerta = [
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Pan Eliminado",
                    "Texto"=>"El pan fue eliminado con éxito del sistema",
                    "Tipo"=>"success"
                ];        
            } else {
                $alerta = [
                    "Alerta"=>"simple",
                    "Titulo"=>"Ups!",
                    "Texto"=>"No se pudo eliminar el pan",
                    "Tipo"=>"error"
                ];
            }
            return mainModel::sweet_alert($alerta,$ruta);
        }

        public function seleccionar_pan_controlador() {
            $codigo = explode("/",$_GET['views']);
            $seleccion = mainModel::ejecutar_consulta_simple("SELECT * FROM panes WHERE pk_pan=$codigo[1]");
            return $seleccion->fetch();
        }

        public function actualizar_pan_controlador() {
            $pan = mainModel::limpiar_cadena($_POST['nombre_pan']);
            $precio = mainModel::limpiar_cadena($_POST['precio_pan']);
            $tipo = mainModel::limpiar_cadena($_POST['tipo_pan']);
            $codigo = mainModel::limpiar_cadena($_POST['codigo-edit']);
            
           
            

            $nombreArchivo = $_FILES['imagen']['name'];
            echo $nombreArchivo;
            $carpeta = "panes";
            $archivo = $_FILES['imagen']['tmp_name'];
            $imagen = "../files/".$carpeta."/".$nombreArchivo;
            $mover = false;
              
            $consultaImagen = mainModel::ejecutar_consulta_simple("SELECT * FROM panes WHERE pk_pan = $codigo");
            $row = $consultaImagen->fetch();

            if($nombreArchivo=="" || $imagen==$row['imagen']) {   
                // echo $row['imagen'];
                // $imagen = $row['imagen'];
                // $imagen = "../files/panes/polveado.jpg";
                $dataPan =  [
                    "Pan"=>$pan,
                    "Precio"=>$precio,
                    "Tipo"=>$tipo,
                    "Codigo"=>$codigo
                ];
                $mover = false;
            } else {           
                $dataPan =  [
                    "Pan"=>$pan,
                    "Precio"=>$precio,
                    "Imagen"=>$imagen,
                    "Tipo"=>$tipo,
                    "Codigo"=>$codigo
                ];    
                $mover = true;
            }        

            $actualizar = panModelo::actualizar_pan_modelo($dataPan,$mover);

            $ruta = "";
            $ser = mainModel::serverURLMain();
            if($actualizar->rowCount()>=1) {
                if($mover==true) {
                    if(move_uploaded_file($archivo,$imagen)) {
                        $alerta = [
                            "Alerta"=>"limpiar",
                            "Titulo"=>"Pan Atualizado",
                            "Texto"=>"El pan fue actualizado con éxito en el sistema",
                            "Tipo"=>"success"
                        ];  
                        $ruta = $ser."pan/";
                    } else {
                        $alerta = [
                            "Alerta"=>"limpiar",
                            "Titulo"=>"Advertencia!",
                            "Texto"=>"La imagen no pudo ser guardada",
                            "Tipo"=>"warning"
                        ];  
                        $ruta = $ser."pan/";
                    }

                } else {
                    $alerta = [
                        "Alerta"=>"limpiar",
                        "Titulo"=>"Pan Atualizado",
                        "Texto"=>"El pan fue actualizado con éxito en el sistema",
                        "Tipo"=>"success"
                    ];  
                    $ruta = $ruta = $ser."pan/";
                }
            } else {
                $alerta = [
                    "Alerta"=>"simple",
                    "Titulo"=>"Ups!",
                    "Texto"=>"No se pudo actualizar el pan",
                    "Tipo"=>"error"
                ];
            }
            return mainModel::sweet_alert($alerta,$ruta);
        }

        public function mostrar_panes_menu_interactivo_controlador() {
            $consulta = mainModel::ejecutar_consulta_simple("SELECT pk_pan, nombre_pan,imagen FROM panes");         
            return $consulta->fetchAll();
        }

        public function mostrar_datos_pan_detalle_controlador() {
            $pk = $_POST['clave'];
            $consulta = mainModel::ejecutar_consulta_simple("SELECT pk_pan,nombre_pan,precio_pan FROM panes WHERE pk_pan = $pk");
            return $consulta->fetch();
        }
    }