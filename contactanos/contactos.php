<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <style>
.container .logo {
    max-width: 200px;
    height: auto;
    margin-right: 20px;
}

.container .contact {
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

.success-message.visible,
.error-message.visible {
    display: block;
}

.success-message.hidden,
.error-message.hidden {
    display: none;
}

.success-message,
.error-message {
    margin-top: 10px;
    padding: 10px;
    border-radius: 4px;
    background-color: #3498db;
    color: white;
    text-align: center;
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
        
        <?php include 'layout/header.php'?>

        <section class="contact">
            <div class="contact-info" style="margin: 100px 0 0 0">
                <img src="img/Mountain-logo-Design-Graphics-9785421-1.png" alt="Company Logo" class="logo">
                <h2>CONTACTANOS</h2>
                <p>Si tiene alguna pregunta o consulta, no dude en comunicarse con nosotros. <br>¡Estamos aquí para ayudar!</p><br>
                <ul>
                    <li><strong>Email:</strong> info@runplaystore.com</li>
                    <li><strong>Telefono:</strong> +1 (555) 123-4567</li>
                    <li><strong>Direccion:</strong> Tlaxcala, Mexico</li>
                </ul>
            </div>

            <div class="contact-form" style="margin: 100px 0 0 0">
                <h2>ENVIANOS UN MENSAJE</h2>
                <?php
                    include 'conexion.php';

                    $showSuccessMessage = false;
                    $showErrorMessage = false;
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $nombre = $_POST["nombre"];
                        $email = $_POST["email"];
                        $mensaje = $_POST["mensaje"];
                    
                        // Validación y procesamiento del formulario
                        if (!empty($nombre) && !empty($email) && !empty($mensaje)) {
                            // Realizar validaciones adicionales si es necesario
                    
                            $stmt = $conexion->prepare("INSERT INTO mensajes (nombre, email, mensaje) VALUES (?, ?, ?)");
                    
                            $stmt->bind_param("sss", $nombre, $email, $mensaje);
                    
                            if ($stmt->execute()) {
                                $showSuccessMessage = true;
                            } else {
                                $showErrorMessage = true;
                            }
                    
                            $stmt->close();
                            $conexion->close();
                        } else {
                            $showErrorMessage = true;
                        }
                    }
                    ?>


                <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="nombre" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>

                    <label for="message">Mensaje:</label>
                    <textarea id="message" name="mensaje" rows="4" required></textarea>

                    <button type="submit">Enviar Mensaje</button>

                    <div class="success-message <?php echo $showSuccessMessage ? 'visible' : 'hidden'; ?>">
                        Mensaje enviado exitosamente.
                    </div>

                    <div class="error-message <?php echo $showErrorMessage ? 'visible' : 'hidden'; ?>">
                        Hubo un error al enviar el mensaje. Por favor, inténtelo de nuevo.
                    </div>

                </form>
            </div>
        </section>

        <?php include 'layout/footer.php'?>
    </div>

</body>

</html>
