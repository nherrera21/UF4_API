<?php

require 'db.php';

function crearActividad($actividad)
{
    global $conexion_mysql;

    $consulta  = "INSERT INTO actividades (Titulo, Ciudad, Fecha, Precio, Usuario, Tipo)  
    VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexion_mysql->prepare($consulta);
    $stmt->bind_param('sssdss', 
    $actividad->titulo, 
    $actividad->ciudad, 
    $actividad->fecha,
    $actividad->precio,
    $actividad->usuario,
    $actividad->tipo); 
    
    $stmt->execute();
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

return $actividades;

}

?>