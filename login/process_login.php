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
    height: 40px;
    color: black;
    font-size: 16px;
}

.login-box input[type="submit"]{
    border: none;
    outline: none;
    height: 40px;
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
        <form action="process_login.php" autocomplete="off" method="post">
        <?php
                session_start();

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST["username"];

                    include('conexion.php');

                    $recaptchaSecretKey = '6LeMum4pAAAAALJh4PuCdLW_2Q6qoPGBwAJVIE-L';

                    $recaptchaResponse = $_POST['g-recaptcha-response'];

                    $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
                    $recaptchaData = [
                        'secret' => $recaptchaSecretKey,
                        'response' => $recaptchaResponse,
                    ];

                    $recaptchaOptions = [
                        'http' => [
                            'method' => 'POST',
                            'content' => http_build_query($recaptchaData),
                        ],
                    ];

                    $recaptchaContext = stream_context_create($recaptchaOptions);
                    $recaptchaResult = file_get_contents($recaptchaUrl, false, $recaptchaContext);

                    $recaptchaResult = json_decode($recaptchaResult, true);

                    if ($recaptchaResult['success'] === true) {
                        $consulta = "SELECT id, puesto, username, pass FROM usuarios WHERE username = '$username'";
                        $resultado = mysqli_query($conexion, $consulta);

                        if (mysqli_num_rows($resultado) == 1) {
                            $usuario = mysqli_fetch_assoc($resultado);

                            if (password_verify($_POST['pass'], $usuario['pass'])) {
                                $_SESSION['user_id'] = $usuario['id'];
                                $_SESSION['username'] = $usuario['username'];
                                $_SESSION['loggedin'] = true;
                                $_SESSION['puesto'] = $usuario['puesto'];

                                header("Location: ../index.php");
                            } else {
                                ?>
                                <div class="resultado_registro"><h3>La Contraseña o Usuario son incorrectos, vuelva a intentarlo.</h3></div>
                                <?php 
                            }
                        } else {
                            ?>
                                <div class="resultado_registro"><h3>La Contraseña o Usuario son incorrectos, vuelva a intentarlo.</h3></div>
                            <?php 
                        }
                    } else {
                        ?>
                            <div class="resultado_registro"><h3>Fallo el reCAPTCHA, vuelva a intentarlo.</h3></div>
                        <?php
                    }


                    
                }
                ?>
            <a href="login.php" class="button">Regresar</a>
        </form>
    </div>

</body>
</html>
