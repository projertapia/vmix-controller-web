<?php
session_start();
if (isset($_GET['access_token']) AND isset($_GET['idVideo'])) {
    $access_token=$_GET['access_token'];
    $video_id = $_GET['idVideo'];
    $showComents=true;
}else{
    $video_id='';
    $access_token=$_GET['access_token'];
    $showComents=false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios FB Live <?php echo $video_id?></title>
    <style>
    *{font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;}
        html, body{padding: 0; margin: 0;}

        .cintillo{
            transition: all 0.5s ease-in-out;
            background-color: #fff;
            min-width: 120px;
            max-width: 100%;
            display: block;
            position: relative;
            bottom: 5%;
            padding: 15px;
            border-radius: 3px;
            box-shadow: 0px 0 10px 0px rgb(0 0 0 / 59%);
            margin: 10px 0 10px 20px;
        }
        .name{
            display: block;
            font-weight: bold;
            font-size: 0.9em;
            color: #ff4801;
        }
        .comment{
            font-size: 1.1em;
            color: #3e3539;
            padding: 5px 5px 5px 10px;
        }
        .hidden{
            left:-500px;
            opacity: 0;
        }
        .show{
            margin: 15px 0;
            left: 5%;
            opacity: 1;
        }
        #contenedor-notificaciones{
            position: absolute;
            left: 0;
            top: 0;
            height: 100vh;
            min-width: 280px;
            max-width: 350px;
            display: flex;
            flex-direction: column-reverse;
        }
    </style>
</head>
<body>
    <?php if(!$showComents){ ?>
        <div class="content">
            <div class="col-sm-6">
                <form method="get">
                    <input type="hidden" name="access_token" value="<?php echo $access_token?>">
                    <div class="mb-3">
                        <label for="idVideo" class="form-label">ID Facebook Video:</label>
                        <input type="text" class="form-control" name="idVideo" id="idVideo">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary ">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    <?php }else{ ?>
    <div id="contenedor-notificaciones" ></div>
    <script>
        let counter_toast = 0;
        let liveVideoId='<?php echo $video_id ?>';
        const accessToken = '<?php echo  $access_token?>';
        const comment_rate ='one_per_two_seconds';
        let url = 'https://streaming-graph.facebook.com/'+liveVideoId+'/live_comments?access_token='+accessToken+'&comment_rate='+comment_rate+'&fieldsfrom{name,id,attachment,object},message';
        const eventSource = new EventSource(url);

        eventSource.onmessage = function(event) {
            counter_toast++;
            console.time("New Event");
            const data = JSON.parse(event.data);
            addToast(counter_toast,data.from.name,data.message);
            console.timeLog("New Event");
        };

        function deleteToast(id){
            let element = document.querySelector(`[data-id="${id}"]`);
            element.classList.add('hidden');
            setTimeout(function() {
                element.parentNode.removeChild(element);
            }, 1000);
        }

        function addToast(id,name,message){
            // Crear un nuevo elemento div para la notificación
            const notificacion = document.createElement('div');
            notificacion.classList.add('cintillo');
            notificacion.setAttribute('data-id', Date.now());

            // Crear un elemento span para el nombre del usuario
            const nombre = document.createElement('span');
            nombre.classList.add('name');
            nombre.textContent = name;

            // Crear un elemento span para el mensaje
            const mensaje = document.createElement('span');
            mensaje.classList.add('message');
            mensaje.textContent = message;

            // Agregar los elementos span al elemento div de la notificación
            notificacion.appendChild(nombre);
            notificacion.appendChild(mensaje);

            // Agregar la notificación al DOM
            const contenedor = document.getElementById('contenedor-notificaciones');
            contenedor.insertAdjacentHTML("afterbegin", notificacion.outerHTML);
            showToast(notificacion);
        }

        function showToast(notificacion) {
            console.log(notificacion);
            notificacion.classList.add('show');
            // Eliminar la notificación después de 15 segundos
            setTimeout(function() {
                deleteToast(notificacion.getAttribute('data-id'));
            }, 15000);
        }
    </script>
    <?php }?>
</body>
</html>