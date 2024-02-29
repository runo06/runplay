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
    <script src="https://kit.fontawesome.com/947038b913.js" crossorigin="anonymous"></script>
    <title>Runplay Store</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

.profile-container {
    max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.profile-header {
    text-align: center;
    padding: 20px;
    background-color: #3EC483;
    color: #fff;
}

.profile-header img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
}

.profile-info {
    padding: 20px;
}

.profile-info p {
    margin: 10px 0;
}


form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

input[type="file"] {
    margin-bottom: 10px;
}

input[type="submit"] {
    background-color: #3498db;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #2980b9;
}

.mensaje {
    margin-top: 10px;
    font-weight: bold;
}

.error {
    color: #e74c3c;
}

.exito {
    color: #27ae60;
}
    </style>
</head>

<?php
    include 'conexion.php';
    include 'layout/header.php';
?>

<body>
    <div class="profile-container">
        <div class="profile-header">
            <?php
            $id_user = $_SESSION['user_id'];
            $sql1 = "SELECT * FROM img_perfil WHERE id_user = $id_user";
            $stmt1 = $conexion->prepare($sql1);
            $stmt1->execute();
            if ($stmt1->error) {
                die("Error en la ejecución de la consulta: " . $stmt1->error);
                ?>
                    <img src="img/Sample_User_Icon.png" alt="img_user">
                <?php
            }else
                $result = $stmt1->get_result();
        
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
                    if (!empty($row['id_user']) && $row['id_user'] == $id_user) {
                        echo '<img src="data:' . $row["tipo"] . ';base64,' . base64_encode($row["dato"]) . '" alt="Imagen">';
                    }else{
                        ?>
                            <img src="img/Sample_User_Icon.png" alt="img_user">
                        <?php
                    }
                }
            
            $stmt1->close();

            $sql = "SELECT * FROM usuarios WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();
            if ($stmt->error) {
                die("Error en la ejecución de la consulta: " . $stmt->error);
            }
            $result = $stmt->get_result();
        
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                ?>
                <h1><?php echo $row['username']; ?></h1>
                <a href="cargar_img_perfil.php">CAMBIAR FOTO DE PERFIL</a>
            </div>
            <div class="profile-info">
                <p>Correo Electrónico: <?php echo $row['email']; ?></p>
                <p>Nombre: <?php echo $row['nombre']; ?></p>
                <p>Apellido: <?php echo $row['apellido']; ?></p>
                <!-- Otras información del perfil -->
            </div>
        </div>
    </body>
    </html>

    <?php 
    

        }else{
            echo "ERROR EN LA CONEXION";
        }
    }else{
        header("Location: login.php");
    }
?>