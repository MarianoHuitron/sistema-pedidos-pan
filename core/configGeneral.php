<?php
    // desarrollo
    // const SERVERURL = "http://localhost/integradora2/";
    // const HOSTURL = echo $_SERVER['SERVER_NAME'];
    // $SERVER =  $_SERVER['SERVER_NAME'].'/'.'integradora2/';
    class serverUrl {
        public function SERVERURL() {
            return $link = 'http://'.$_SERVER['SERVER_NAME'].':80/integradora2/';
        }
    }

    const EMPRESA = "Panadería San José";
    date_default_timezone_set("America/Mazatlan");