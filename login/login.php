<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Mountain-logo-Design-Graphics-9785421-1.png">
    <script src="https://kit.fontawesome.com/947038b913.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style-login.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
    width: 350px;
    height: 525px;
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

.login-box label{
    margin: 0;
    padding: 0;
    font-weight: bold;
    display: block;
}

.login-box input{
    width: 100%;
    margin-bottom: 20px;
}

.login-box input[type="text"],
.login-box input[type="password"]{
    border: none;
    border-bottom: 1px solid black;
    background: transparent;
    outline: none;
    height: 35px;
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

.login-box input[type="submit"]:hover{
    transform: scale(1.1);
}

.login-box a{
    text-decoration: none;
    font-size: 13px;
    line-height: 18px;
    color: #283747;
}

.login-box a:hover{
    transform: scale(1.2);
    color: #3EC483;   
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
        <h1>BIENVENIDO</h1>
        <form action="process_login.php" autocomplete="off" method="post">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="pass" required><br>

            <div class="g-recaptcha" data-sitekey="6LeMum4pAAAAAIHxFbV2BF6THLTGqH3DZKhX0V-o"></div><br>

            <input type="submit" value="Entrar">

            <a href="#">¿Olvidaste tu Contraseña?</a><br>
            <a href="registro.php">Registrate aqui.</a><br><br>
            <a href="index.php" class="button">Ingresar sin Iniciar Sesion</a>
        </form>
    </div>

</body>
</html>