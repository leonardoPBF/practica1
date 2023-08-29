<?php
// Variables de conexion a la base de datos
$server   = "localhost";
$username = "root";
$password = "";
$database = "test_website";
$puerto = '8080';

// Conexion a la base de datos
$mysqli = new mysqli($server, $username, $password, $database, $puerto);

// Conectar a la base de datos
if ($mysqli->connect_error) {
    die('Conexión falló : '.$mysqli->connect_error);
}
?>