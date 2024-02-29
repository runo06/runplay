<!DOCTYPE html>
<html lang="en">

    <style>
.container .logo {
    max-width: 200px;
    height: auto;
    margin-right: 20px;
}

.container .contact {
    margin-top: 10px;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.contact-info,
.contact-form {
    flex: 1;
    padding: 20px;
    box-sizing: border-box;
}

.contact-info ul {
    list-style: none;
    padding: 0;
}

.contact-form form {
    display: flex;
    flex-direction: column;
}

.contact-form label {
    margin-bottom: 5px;
}

.contact-form input,
.contact-form textarea {
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.contact-form button {
    padding: 10px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.success-message {
            margin-top: 20px;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 4px;
            display: none;
        }

@media (max-width: 768px){
    .contact {
        flex-direction: column;
    }

    .contact-info,
    .contact-form {
        width: 100%;
        margin-bottom: 20px;
    }
}
    </style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Mountain-logo-Design-Graphics-9785421-1.png">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/947038b913.js" crossorigin="anonymous"></script>
    <title>Runplay Store</title>
</head>

<body>
    <div class="container">
        

                <?php
                    include 'conexion.php';

                    $showSuccessMessage = false;

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $nombre = $_POST["nombre"];
                        $email = $_POST["email"];
                        $mensaje = $_POST["mensaje"];

                        $stmt = $conexion->prepare("INSERT INTO mensajes (nombre, email, mensaje) VALUES (?, ?, ?)");

                        $stmt->bind_param("sss", $nombre, $email, $mensaje);

                        $stmt->execute();
                        
                        $showSuccessMessage = true;
                        
                        $stmt->close();
                        $conexion->close();

                        if ($showSuccessMessage): ?>
                        <div class="success-message">
                            <p>Mensaje enviado exitosamente.</p>
                        </div>
                    <?php endif; 

                    }

                    ?>

    </div>

</body>

</html>
