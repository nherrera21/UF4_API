<?php

$conexion_mysql = mysqli_connect('localhost', 'root', 'root', 'ifpdb',3306);

if ($conexion_mysql->connect_errno) {
    printf("Error de conexión a la base de datos: %s\n", $conexion_mysql->connect_error);
    exit();
}






?>