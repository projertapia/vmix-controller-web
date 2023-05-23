<?
session_start();
if (isset($_GET['pageid'])) {
    $pageid = $_GET['pageid'];
    $login = '7fb71502305f1d6abe732079b6ed423ab0efdd135892914c793c929c28a2eb6f';
    $pagelaunch="https://chat.projerdesigns.com/oauth/paso-uno.php?pageid=$pageid";
    header('Location: '.$pagelaunch);
}else{

}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obtener comentarios FB Live</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/mystyle.css" rel="stylesheet">
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="col-sm-6">
            <form method="get">
                <div class="mb-3">
                    <label for="pageid" class="form-label">ID Facebook Page:</label>
                    <input type="website" class="form-control" name="pageid" id="pageid">
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary ">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>