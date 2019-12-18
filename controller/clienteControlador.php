<?php
    if ($peticionAjax) {
        require_once "../model/clienteModelo.php";
    } else {
        require_once "./model/clienteModelo.php";
    }

    class clienteControlador extends clienteModelo {
        // funcion para agregar un cliente
        public function agregar_cliente_controlador() {
            $negocio = mainModel::limpiar_cadena($_POST['nombre_tienda']);
            $encargado = mainModel::limpiar_cadena($_POST['nombre_encargado']);
            $telefono = mainModel::limpiar_cadena($_POST['numero_tel']);
            $direccion = mainModel::limpiar_cadena($_POST['direccion']);
            $localidad = mainModel::limpiar_cadena($_POST['localidad']);

            $dataCliente = [
                "Negocio"=>$negocio,
                "Encargado"=>$encargado,
                "Telefono"=>$telefono,
                "Direccion"=>$direccion,
                "Localidad"=>$localidad
            ];

            $guardarCliente = clienteModelo::agregar_cliente_modelo($dataCliente);

            if($guardarCliente->rowCount()>=1) {
                $alerta = [
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Cliente registrado",
                    "Texto"=>"El cliente se registró con éxito en el sistema",
                    "Tipo"=>"success"
                ];
                $ser = mainModel::serverURLMain();
                $ruta = $ser."cliente/";
            } else {
                $alerta = [
                    "Alerta"=>"simple",
                    "Titulo"=>"Cliente NO registrado",
                    "Texto"=>"No se pudo registrar el cliente",
                    "Tipo"=>"error"
                ];
                $ruta = "";
            }
            return mainModel::sweet_alert($alerta,$ruta);
        }

        public function mostrar_clientes_controlador() {
            $datos = mainModel::ejecutar_consulta_simple("SELECT * FROM clientes");

            $arreglo['data'] = [];

            while($row =  $datos->fetch(PDO::FETCH_ASSOC)) {
                $arreglo['data'][] = $row;
            }
            return json_encode($arreglo);
        }

        public function eliminar_cliente_controlador() {
            $pk = $_POST['codigoDelete'];
            $eliminar = clienteModelo::eliminar_cliente_modelo($pk);

            if($eliminar->rowCount()>=1) {
                $alerta = [
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Cliente Eliminado",
                    "Texto"=>"El cliente fue eliminado con éxito del sistema",
                    "Tipo"=>"success"
                ];
                $ruta = "";
            } else {
                $alerta = [
                    "Alerta"=>"simple",
                    "Titulo"=>"Ups!",
                    "Texto"=>"No se pudo eliminar el cliente",
                    "Tipo"=>"error"
                ];
                $ruta = "";
            }
            return mainModel::sweet_alert($alerta,$ruta);
        }

        public function seleccionar_cliente_controlador() {
            $cliente = explode("/",$_GET['views']);
            $res = mainModel::ejecutar_consulta_simple("SELECT * FROM clientes WHERE pk_cliente = $cliente[1]");
            
            while($row = $res->fetch(PDO::FETCH_ASSOC)) {
                $arreglo[] = $row;
            }
            
            return $arreglo;
        }

        public function actualizar_cliente_controlador() {
            $negocio = mainModel::limpiar_cadena($_POST['nombre_tienda']);
            $encargado = mainModel::limpiar_cadena($_POST['nombre_encargado']);
            $telefono = mainModel::limpiar_cadena($_POST['numero_tel']);
            $direccion = mainModel::limpiar_cadena($_POST['direccion']);
            $localidad = mainModel::limpiar_cadena($_POST['localidad']);
            $clave = mainModel::limpiar_cadena($_POST['codigo-editar']);

            $dataCliente = [
                "Negocio"=>$negocio,
                "Encargado"=>$encargado,
                "Telefono"=>$telefono,
                "Direccion"=>$direccion,
                "Localidad"=>$localidad,
                "Clave"=>$clave
            ];

            $actualizar = clienteModelo::actualizar_cliente_modelo($dataCliente);

            $ruta = "";
            if($actualizar->rowCount()>=1) {
                $alerta = [
                    "Alerta"=>"limpiar",
                    "Titulo"=>"Cliente Actualizado",
                    "Texto"=>"El cliente fue actualizado con éxito en el sistema",
                    "Tipo"=>"success"
                ];
                $ser = mainModel::serverURLMain();
                $ruta = $ser."cliente/";
            } else {
                $alerta = [
                    "Alerta"=>"simple",
                    "Titulo"=>"Ups!",
                    "Texto"=>"No se pudo actualizar el cliente",
                    "Tipo"=>"error"
                ];
                $ruta = "";
            }
            return mainModel::sweet_alert($alerta,$ruta);
        }

        public function mostrar_clientes_menu_controlador() {
            $consulta = mainModel::ejecutar_consulta_simple("SELECT pk_cliente,nombre_negocio FROM clientes");
            return $consulta->fetchAll();
        }

        public function mostrar_localidades_controlador() {
            $consulta = mainModel::ejecutar_consulta_simple("SELECT distinct(localidad) FROM clientes ORDER BY localidad");
            return $consulta->fetchAll();
        }
    }