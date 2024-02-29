<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Mountain-logo-Design-Graphics-9785421-1.png">
    <script src="https://kit.fontawesome.com/947038b913.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style-login.css">
    <title>Runplay Store</title>
</head>

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
    width: 320px;
    height: 280px;
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
    background-color: #3EC483;
    font-size: 18px;
    border-radius: 20px;
    transition: transform 0.3s ease; 
}

.login-box a.button:hover {
    transform: scale(1.1);
    color: white;
}


@media (max-width: 768px){
    body{
        background-size: auto 100%;
    }
}
</style>

<body>

    <div class="login-box">
        <img class="logo" src="img/Mountain-logo-Design-Graphics-9785421-1.png" alt="logo">
        <h1>Runplay Store</h1>
        <form autocomplete="off" method="post">
            <?php
            session_start();
            $loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
            if ($loggedIn) {

                include 'conexion.php';

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagen"])) {
                    $id_user = $_SESSION['user_id'];
                    $nombre = $_FILES["imagen"]["name"];
                    $tipo = $_FILES["imagen"]["type"];
                    $datos = file_get_contents($_FILES["imagen"]["tmp_name"]);

                    $stmt_existencia = $conexion->prepare("SELECT * FROM img_perfil WHERE id_user = ?");
                    $stmt_existencia->bind_param("i", $id_user);
                    $stmt_existencia->execute();
                    $result_existencia = $stmt_existencia->get_result();

                    if ($result_existencia->num_rows > 0) {
                        $stmt_actualizacion = $conexion->prepare("UPDATE img_perfil SET nombre = ?, tipo = ?, dato = ? WHERE id_user = ?");
                        $stmt_actualizacion->bind_param("sssi", $nombre, $tipo, $datos, $id_user);

                        if ($stmt_actualizacion->execute()) {
                            ?>
                                <div class="resultado_registro"><h3>Se ha actualizado correctamente la imagen.</h3></div>
                            <?php 
                        } else {
                            ?>
                                <div class="resultado_registro"><h3>Error al actualizar la imagen: .<?php $stmt_actualizacion->error; ?></h3></div>
                            <?php 
                        }

                        $stmt_actualizacion->close();
                    } else {
                        $stmt_insercion = $conexion->prepare("INSERT INTO img_perfil (id_user, nombre, tipo, dato) VALUES (?, ?, ?, ?)");
                        $stmt_insercion->bind_param("isss", $id_user, $nombre, $tipo, $datos);

                        if ($stmt_insercion->execute()) {
                            ?>
                            <div class="resultado_registro"><h3>Se ha cargado correctamente la imagen.</h3></div>
                            <?php
                        } else {
                            ?>
                                <div class="resultado_registro"><h3>Error al cargar la imagen: .<?php $stmt_insercion->error; ?></h3></div>
                            <?php
                        }

                        $stmt_insercion->close();
                    }

                    $stmt_existencia->close();
                } else {
                    ?>
                    <div class="resultado_registro"><h3>Error en la solicitud.</h3></div>
                    <?php            }

                $conexion->close();
                ?>
                <a href="perfil.php" class="button">Regresar</a>
            </form>
        </div>

    </body>
    </html>

<?php
}else{
    header("Location: login.php");
}
?>

