<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_SESSION['puesto']) && $_SESSION['puesto'] === 'admin'){
?>

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
    background: linear-gradient(#BB8FCE, white);
    height: 100vh;
    background-size: auto auto;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}

.login-box{
    width: 320px;
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

.login-box a.button,
.login-box a.button_alert {
    width: 250;
    display: flex;
    text-align: center;
    align-items: center;
    justify-content: center;
    padding: 10px 20px;
    text-decoration: none;
    color: white;
    
    font-size: 18px;
    border-radius: 20px;
    transition: transform 0.3s ease; 
}

.login-box a.button{
    background-color: #3EC483;
}

.login-box a.button_alert{
    background-color: red;
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
            <div class="resultado_registro"><h3>Seleciona la opcion que deseas hacer:</h3></div>
            <a href="juegos.php" class="button">EDITAR JUEGOS O APP</a><br>
            <a href="usuarios.php" class="button">EDITAR USUARIO</a><br><br>

            <a href="../index.php" class="button_alert">Regresar</a>
        </form>
    </div>

</body>
</html>


<?php
} else {
    header('Location: ../index.php'); 
    exit();
}

} else {
    header('Location: ../index.php'); 
    exit();
}
?>