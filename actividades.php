<?php

require 'db.php';

function crearActividad()
{
    $actividad = json_decode(file_get_contents('php://input'), true);
    global $conexion_mysql;

    $consulta  = "INSERT INTO actividades (Titulo, Ciudad, Fecha, Precio, Usuario, Tipo)  
    VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexion_mysql->prepare($consulta);
    $stmt->bind_param('sssdss', 
                                $actividad['titulo'], 
                                $actividad['ciudad'], 
                                $actividad['fecha'],
                                $actividad['precio'],
                                $actividad['usuario'],
                                $actividad['tipo']); 
    
    $resultado = $stmt->execute();

    if($resultado)
    {

     header("HTTP/1.1 200 OK");

    }

else 
{

header('HTTP/1.1 500 Internal Server Error');

}

}

function listarActividades()
{
    global $conexion_mysql;

    $actividades = array();

    $consulta  = "SELECT * FROM actividades";

    $resultado = mysqli_query($conexion_mysql, $consulta);

    if($resultado)
    {
        while($fila = mysqli_fetch_assoc($resultado))
		{
            array_push($actividades, $fila);
		}

        header("HTTP/1.1 200 OK");
        echo json_encode($actividades);
    }
	else 
    {

    header('HTTP/1.1 500 Internal Server Error');
}
}

function eliminarActividad()
{

$id = $_GET["id"];         

global $conexion_mysql;

$consulta = "DELETE FROM actividades WHERE id=?";

$stmt = $conexion_mysql->prepare($consulta);
$stmt->bind_param('d',$id);

$resultado = $stmt->execute();

if($resultado)
{
    header("HTTP/1.1 200 OK");
}
else 
{

    header('HTTP/1.1 500 Internal Server Error');
}
}

function modificarActividad()
{

$id = $_GET["id"];    
$actividad = json_decode(file_get_contents('php://input'), true);

global $conexion_mysql;

$consulta = "UPDATE actividades
                SET titulo = ?,
                    ciudad = ?,
                    fecha = ?,
                    precio = ?,
                    usuario = ?,
                    tipo = ?
                WHERE id = ?";

$stmt = $conexion_mysql->prepare($consulta);
$stmt->bind_param('sssdssd',
                        $actividad["titulo"], 
                        $actividad["ciudad"], 
                        $actividad["fecha"],
                        $actividad["precio"],
                        $actividad["usuario"],
                        $actividad["tipo"], 
                        $id);

$resultado = $stmt->execute();

if($resultado)
{
    header("HTTP/1.1 200 OK");
}
else 
{

    header('HTTP/1.1 500 Internal Server Error');
}
}

?>