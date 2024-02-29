<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Mountain-logo-Design-Graphics-9785421-1.png">
    <script src="https://kit.fontawesome.com/947038b913.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Runplay Store</title>
</head>
<body>
    <?php
        include 'layout/header.php';
        include 'layout/nav_usuarios.php';
    ?>
    

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