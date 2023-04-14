<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lee el contenido del archivo config.json en una variable
    $config_data = file_get_contents('config.json');
    // Convierte el contenido JSON en un objeto de PHP
    $config = json_decode($config_data);
    // Accede a los datos del objeto de PHP
    $host = $config->host;
    $port = $config->port;
    $socket = fsockopen($host, $port, $errno, $errstr, 10);
    if (!$socket) {
        $response = "Error de conexión: $errno - $errstr";
    }else{
        $json_data = file_get_contents('php://input');
        // Convierte el JSON en un objeto o array de PHP
        $data = json_decode($json_data, true);
        // Accede a los datos del objeto o array de PHP
        $function = $data['function'];
        $input = $data['input'];
        $type = $data['type'];
        $command = 'No comand';
        if($type == 'inputs'){
            $command  = "FUNCTION $function Input=$input";
        }
        fwrite($socket, $command);
        $response = fgets($socket);
        $response = preg_replace("[\n|\r|\n\r]", "", $response);
        fclose($socket);
    }
}else{
    $response = 'No post data';
}
echo  '{"message":"'.$response.'","comand":"'.$command.'"}';
?>