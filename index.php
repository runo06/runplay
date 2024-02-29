<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Mountain-logo-Design-Graphics-9785421-1.png">
    <link rel="stylesheet" href="css/style_2.css">
    <script src="https://kit.fontawesome.com/947038b913.js" crossorigin="anonymous"></script>
    <title>Runplay Store</title>
    <style>
        *{
    margin: 0;
    padding: 0;
}

body{
    background-color: #fff;
    color: black;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
}


/**NAVEGACION**/

body .nav-container{
    background-color: #efefef;
    height: 55px;
    margin: 0 0 0 0;
    align-items: center;
    list-style: none;
    display: flex;
    justify-content: center;
}

body .nav-container .nav-links li{
    text-decoration: none;
    display: inline-block;
    transform: translate(-50, 50);
    padding: 0 20px;
}

body .nav-container .nav-links li:hover{
    transform: scale(1.1);   
}

body .nav-container .nav-links li a{
    color: #283747;
}

body .nav-container .nav-links li a:hover{
    color: #3EC483;
    transform: scale(1.2);
}

/**VISTA PRINCIPAL**/

.contenedor .vista_principal img{
    width: 100%;
    height: auto;
    padding: 10px;
}

/**PRODUCTOS**/

.contenedor_productos{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
    padding: 20px;
}


.contenedor .producto {
    margin: 15px;
    padding: 20px;
    width: 370px;
    height: auto;
    background-color: #efefef;
    transition: all 300ms ease;
}
.contenedor .producto:hover{
    background: linear-gradient(#BFC9CA, white);
    transform: scale(1.1);
}

.contenedor .producto p{
    font-size: 20px;
    text-align: center;
}

.contenedor .producto .img{
    max-width: 320px;
    height: 200px;
    text-align: center;
    justify-content: center;
    align-items: center;
}

.contenedor .producto img{
    width: auto;
    height: 100%;
    display: block;
    margin: 0 auto;
}

.contenedor .boton_comprar{
    text-align: center;
    margin-top: 9px;
}

.contenedor .boton_comprar button{
    padding: 15px 10px;
    font-size: 20px;
    border-radius: 5px;
    background-color: #D5DBDB;
    border-color: transparent;
    color: #212F3D;
}

.contenedor .boton_comprar button:hover{
    transform: scale(1.1);
    background-color: #3EC483;
    color: black;
}


/**FOOTER**/
.contenedor .footer{
    background-color: #273746;
    color: #fff;
    grid-column-start: 1;
    grid-column-end: -1;
    width: 100%;
    height: auto;
}

.footer .grupo-1{
    width: 100%;
    max-width: 1200px;
    margin: auto;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 50px;
    padding: 45px 0px;
    display: flex;
}

.footer .grupo-1 .box{
    max-width: 400px;
}

.footer .grupo-1 .box figure{
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.footer .grupo-1 .box figure img{
    width: 50px;
    transition: all 300ms ease;
}

.footer .grupo-1 figure img:hover{
    transform: scale(1.2);
}

.footer .grupo-1 .box h2{
    color: white;
    margin-bottom: 25px;
    font-size: 27px;
}

.footer .grupo-1 .box p{
    color: white;
    margin-bottom: 10px;
}

.footer .grupo-1 .red-social a{
    display: inline-block;
    text-decoration: none;
    width: 45px;
    height: 45px;
    line-height: 45px;
    color: white;
    margin-right: 10px;
    background-color: #212F3D;
    text-align: center;
    transition: all 300ms ease;
}

.footer .grupo-1 .red-social a:hover{
    color: #3EC483;
}

.footer .grupo-2{
    background-color: #212F3D;
    color: white;
    padding: 15px 10px;
    text-align: center;
}

.footer .grupo-2 small{
    font-size: 15px;
}

@media (max-width: 768px){

    .contenedor .vista_principal img{
        width: 100%;
        height: auto;
        padding-top: 10px;
    }

    .footer .grupo-1 .box p{
        max-width: 340px;
    }

    .box figure{
        display: none;
    }
}
    </style>

</head>

<body>
    <div class="contenedor">
    
        
        <?php include 'layout/header.php'?>

        <hr>

        <?php include 'layout/navegacion.php'?>

        <div class="vista_principal">
            <img src="img/pexels-cottonbro-studio-3945657 (1).jpg" alt="" class="img_principal">
        </div>

        <div class="contenedor_productos">
        <?php include 'conexion.php';
            $sql = "SELECT id,link_imagen,nombre_juego FROM juego";
            $result = $conexion->query($sql);
        
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    ?>
                    <div class="producto">
                        <div class="img">
                            <a href='detalle_producto.php?id=<?php echo $row['id'];?>'><img src= '<?php echo $row['link_imagen']?>' alt=""></a>
                        </div>
                        <div class="info_producto">
                            <p><br><?php echo $row['nombre_juego']; ?></p>    
                        </div>
                        <div class="boton_comprar">
                            <a href='detalle_producto.php?id=<?php echo $row['id']; ?>'><button>OBTENER</button></a>
                        </div>
                    </div>
                <?php
                    }
                }else{
                    echo "<h2>No hay productos disponibles.</h2>";
                }
                ?>
            </div>

        <?php include 'layout/footer.php'?>

    </div>
</body>
</html>

