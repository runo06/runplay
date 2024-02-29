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
    width: 180px;
    height: auto;
    border-radius: 50%;
    position: absolute;
    top: -50px;
    left: calc(50% - 93px);
}

.login-box h1{
    margin: 0;
    padding: 0 0 15px;
    font-size: 22px;
    text-align: center;
}

.login-box label{
    margin: 0;
    padding: 0;
    font-weight: bold;
    display: block;
}

.login-box input{
    width: 100%;
    margin-bottom: 15px;
}

.login-box input[type="text"],
.login-box input[type="password"],
.login-box input[type="email"]{
    border: none;
    border-bottom: 1px solid black;
    background: transparent;
    outline: none;
    height: 30px;
    color: black;
    font-size: 16px;
}

.login-box input[type="submit"]{
    border: none;
    outline: none;
    height: 35px;
    background-color: #3EC483;
    color: white;
    font-size: 18px;
    border-radius: 20px;
    transition: transform 0.3s ease; 
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

.login-box input[type="submit"]:hover{
    transform: scale(1.1);
}

.login-box a{
    text-decoration: none;
    font-size: 12px;
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

@media (max-width: 768px){
    body{
        background-size: auto 100%;
    }
}
</style>

<body>

    <div class="login-box">
        <img class="logo" src="img/Mountain-logo-Design-Graphics-9785421-1.png" alt="logo">
        <h1>REGISTRO</h1>
        <form method="post" autocomplete="off">
            
            <?php 
                
                $username = $_POST['username'];
                $name = $_POST['name'];
                $apellidos = $_POST['apellidos'];
                $email = $_POST['email'];
                $puesto = "usuario"; 

                if($_POST['pass'] == $_POST['repass']){
                    include('conexion.php');
                    if (empty($_POST["username"]) or empty($_POST["name"]) or  empty($_POST["apellidos"]) or empty($_POST["email"]) or empty($_POST["pass"])) {
                        ?>
                        <div class="resultado_registro"><h3>LLENA TODOS LOS CAMPOS</h3></div>
                        <?php
                    }else{

                        $hashed_password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

                        $consulta = $conexion->prepare("INSERT INTO usuarios (puesto, username, nombre, apellido, email, pass) VALUES (?, ?, ?, ?, ?, ?)");
                        $consulta->bind_param("ssssss", $puesto, $username, $name, $apellidos, $email, $hashed_password);
                        $resultado = $consulta->execute();
                        $consulta->close();
                    if($consulta){
                        ?>
                        <div class="resultado_registro"><h3>SE HA ENVIADO LA INFORMACION</h3></div>
                        <?php 
                    }
                    else{
                        ?>
                        <div class="resultado_registro"><h3>SE PRODUJO UN ERROR</h3></div>
                        <?php

                    }
                    } 
                }else{?>
                    <div class="resultado_registro">
                        <h3>LA CONTRASEÑA NO ES IGUAL, VUELVA A INTENTAR</h3>
                    </div>
                    <?php
                }
?>   

            <a href="login.php" class="button">Regresar</a>
        </form>
    </div>

</body>
</html>