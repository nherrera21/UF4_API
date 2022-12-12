<?php 
require 'actividades.php';

$tipo_solicitud = $_SERVER["REQUEST_METHOD"];

switch($tipo_solicitud)

{
 case "GET":
    listarActividades();
    break;
 case "POST":
    crearActividad();
    break;
    case "DELETE":
        eliminarActividad();
        break;
    case "PUT":
        modificarActividad();
        break;

}

?>