<?php
session_start();
$pagelaunch="https://chat.projerdesigns.com/oauth/";
if (isset($_GET['pageid'])) {
    $pageid = $_GET['pageid'];
    // Calcula la fecha de expiración para dentro de 1 mes
    $expiracion = time() + (30 * 24 * 60 * 60); // 30 días * 24 horas * 60 minutos * 60 segundos
    // Establece la cookie con la duración de 1 mes
    setcookie("pageid", $pageid, $expiracion);
    $app_id = '3388799608036588';
    $redirect_uri = $pagelaunch.'paso-dos.php';
    $scope = 'read_insights'; // Permisos que solicitas al usuario

    $authorization_url = 'https://www.facebook.com/v12.0/dialog/oauth?client_id=' . $app_id . '&redirect_uri=' . urlencode($redirect_uri) . '&scope=' . urlencode($scope);

    // Redirige al usuario a la URL de autorización de Facebook
    header('Location: ' . $authorization_url);
    exit;
}else{
    header('Location: '.$pagelaunch.'?error=no-data');
}
?>