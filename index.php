<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/unidades.controlador.php";
require_once "controladores/vehiculos.controlador.php";
require_once "controladores/cargas.controlador.php";
//require_once "controladores/descargas.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/unidades.modelo.php";
require_once "modelos/vehiculos.modelo.php";
require_once "modelos/cargas.modelo.php";
//require_once "modelos/descargas.modelo.php";

//require_once "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();