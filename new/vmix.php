<?php
// Obtener el nombre del input del formulario
$inputName = $_POST['inputName'];

// Crear una conexión TCP con la API de VMix
$host = 'localhost';
$port = 8088;
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_connect($socket, $host, $port);

// Enviar el comando a la API de VMix
$command = 'Function=FunctionName(Input=' . $inputName . ')';
socket_write($socket, $command, strlen($command));

// Cerrar la conexión TCP
socket_close($socket);
?>