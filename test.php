<?php
// Lee el contenido del archivo config.json en una variable
$config_data = file_get_contents('config.json');
// Convierte el contenido JSON en un objeto de PHP
$config = json_decode($config_data);
// Accede a los datos del objeto de PHP
$host = $config->host;
$port = $config->port;
/*$socket = fsockopen($host, $port, $errno, $errstr, 10);
if (!$socket) {
    $response = "Error de conexión: $errno - $errstr";
}else{
    $function = 'SUBSCRIBE TALLY';
    $input = "";
    $command  = "$function $input";
    fwrite($socket, $command);
    $response = fgets($socket);
}
echo  '{"message":"'.$response.'","comand":"'.$command.'"}';*/
    $socket  = stream_socket_client("tcp://$host:$port", $errno, $errstr, 10);

    if (!$socket ) {
        echo "Error de conexión: $errno - $errstr";
    } else {
        $function = 'PreviewInput';
        $input = '2';
        $command  = "FUNCTION $function Input=$input";
       //$command = "SUBSCRIBE TALLY";
        fwrite($socket , $command);
        $response = fgets($socket );
        echo $response;
        for ($i = 0; $i < 4; $i++) {
            $data = fgets($socket);
            echo $data;
        }

        // Cerrar la conexión
       fclose($sock);
    }
?>