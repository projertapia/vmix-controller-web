<?php
session_start();
$pagelaunch="https://chat.projerdesigns.com/oauth/";
$app_id = '3388799608036588';
$app_secret = '507bc40345d3bbdee065260519428dce';
$redirect_uri = $pagelaunch.'paso-dos.php';
$code = $_GET['code'];

$token_url = 'https://graph.facebook.com/v12.0/oauth/access_token';

$params = array(
    'client_id' => $app_id,
    'redirect_uri' => $redirect_uri,
    'client_secret' => $app_secret,
    'code' => $code
);

// Configura la solicitud cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $token_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

// Realiza la solicitud cURL y obtén la respuesta
$response = curl_exec($ch);

// Cierra la conexión cURL
curl_close($ch);

// Analiza la respuesta JSON
$response_data = json_decode($response, true);

// Verifica si el token de acceso existe y no está vacío
if (isset($response_data['access_token']) && !empty($response_data['access_token'])) {
    // Obtén el token de acceso
    $access_token = $response_data['access_token'];
    $authorization_url = $pagelaunch.'paso-tres.php/?access_token='.$access_token;

    // Redirige al usuario a la URL de autorización de Facebook
    header('Location: ' . $authorization_url);
} else {
    // Error al obtener el token de acceso
    echo 'Error al obtener el token de acceso de Facebook.';
}
?>