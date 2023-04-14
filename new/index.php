<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input</title>
</head>
<body>
    <form id="vmixForm">
        <label for="inputName">Input Name:</label>
        <input type="text" id="inputName" name="inputName">
        <button type="submit">Change Input</button>
    </form>
    <script>
        // Obtener el formulario
        const form = document.getElementById('vmixForm');

        // Agregar un evento de escucha para enviar la solicitud al archivo PHP
        form.addEventListener('submit', function(event) {
        event.preventDefault();

        const inputName = document.getElementById('inputName').value;

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
            console.log(this.responseText);
            }
        };
        xhr.open('POST', 'vmix.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('inputName=' + encodeURIComponent(inputName));
        });
    </script>
</body>
</html>