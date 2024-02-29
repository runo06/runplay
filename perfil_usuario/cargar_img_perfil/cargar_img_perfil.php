<?php
session_start();
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
if ($loggedIn) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Mountain-logo-Design-Graphics-9785421-1.png">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/947038b913.js" crossorigin="anonymous"></script>
    <title>Runplay Store</title>
    <style>
          body{
    margin: 0;
    padding: 0;
    background-image: url(fondo_login.jpg);
    background-size: 100% auto;
    background-position: center;
    background-repeat: no-repeat;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    height: 100vh;
}

.login-box{
    width: 420px;
    height: 400px;
    background-color: #efefef;
    color: black;
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%, -50%);
    box-sizing: border-box;
    padding: 70px 30px;
    border-radius: 15px;
}

.login-box .logo{
    width: 100px;
    height: auto;
    border-radius: 50%;
    position: absolute;
    top: -50px;
    left: calc(50% - 50px);
}

.login-box h1{
    margin: 0;
    padding: 0 0 20px;
    font-size: 22px;
    text-align: center;
}


.login-box a{
    text-decoration: none;
    font-size: 13px;
    line-height: 20px;
    color: #283747;
}

.login-box a:hover{
    transform: scale(1.2);
    color: #3EC483;   
}

.login-box .resultado_registro{
    text-align: center;
}

.login-box a.button {
    width: 250;
    display: flex;
    text-align: center;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    text-decoration: none;
    color: white;
    background-color: #F50808;
    font-size: 18px;
    border-radius: 20px;
    transition: transform 0.3s ease; 
}

.login-box a.button:hover {
    transform: scale(1.1);
    color: white;
}


.drop-area {
            border: 2px dashed #ccc;
            border-radius: 5px;
            padding: 20px;
            cursor: pointer;
        }

        .file-label {
            display: block;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .file-icon {
            font-size: 24px;
        }

        .upload-form {
            text-align: center;
        }

        .upload-button {
            background-color: #3EC483;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .upload-button:hover {
            background-color: #2E9E75;
        }

        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            margin: -1px;
            padding: 0;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }


@media (max-width: 768px){
    body{
        background-size: auto 100%;
    }

    .login-box{
        width: 100%;
        height: auto;
    }

    .upload-form{
        align-items: center;
        text-align: center;
    }
    

}

    </style>
</head>
<body>
    <div class="login-box">
        <img class="logo" src="img/Mountain-logo-Design-Graphics-9785421-1.png" alt="logo">
        <h1>Runplay Store</h1>
        <div id="drop-area" class="drop-area">
            <form action="procesar_img_perfil.php" method="post" enctype="multipart/form-data" class="upload-form">
                <input type="file" name="imagen" id="fileElem" accept="image/*" class="visually-hidden" required>
                <label for="fileElem" class="file-label">
                    <span class="file-icon">&#128193;</span> Selecciona o arrastra una imagen aquí
                </label>
                <button type="submit" class="upload-button">Cargar Imagen</button>
            </form>
        </div>
        

        <br><br><a href="perfil.php" class="button">Regresar</a>
    </div>
</body>
<script>
     document.addEventListener('DOMContentLoaded', function() {
            var dropArea = document.getElementById('drop-area');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });

            dropArea.addEventListener('drop', handleDrop, false);

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight() {
                dropArea.classList.add('highlight');
            }

            function unhighlight() {
                dropArea.classList.remove('highlight');
            }

            function handleDrop(e) {
                var dt = e.dataTransfer;
                var files = dt.files;

                handleFiles(files);
            }

            function handleFiles(files) {
                var file = files[0];
                var fileElem = document.getElementById('fileElem');
                fileElem.files = files;

                // Puedes realizar otras acciones con el archivo aquí si es necesario

                // Mostrar el nombre del archivo seleccionado
                document.querySelector('.file-label').innerText = 'Archivo seleccionado: ' + file.name;
            }
        });
</script>

</html>


<?php 
}else{
    header("Location: login.php");
}
?>
