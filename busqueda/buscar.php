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
    <style>.contenedor .footer{
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
}</style>
</head>

<body>
    <div class="contenedor">
        
        <?php include 'layout/header.php'?>

        <?php include 'layout/nav_busqueda.php'?>

        
        <?php 
            include 'conexion.php';
            $sql = "SELECT id,link_imagen,nombre_juego FROM juego";
            $result = $conexion->query($sql);

            

            if(isset($_GET['q'])){
            
                $campo = $_GET['q'];

                $sql = "SELECT id, link_imagen, nombre_juego FROM juego WHERE nombre_juego LIKE '%$campo%'";
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
            }
                ?>
            

        <?php include 'layout/footer.php'?>

    </div>
</body>
</html>