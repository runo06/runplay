<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/Mountain-logo-Design-Graphics-9785421-1.png">
    <link rel="stylesheet" href="css/style-productos.css">
    <script src="https://kit.fontawesome.com/947038b913.js" crossorigin="anonymous"></script>
    <title>Runplay store</title>
</head>

<style>
    .botones_link{
        padding: 3px;
        display: flex;
    }

    .links{
        display: flex;
    }

    @media (max-width: 768px){
        .links{
            text-align: center;
            justify-content: center;
            align-items: center;
        }
    }
</style>

<body>
    <div class="container">
        
        <?php include 'layout/header.php';
            $loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
            include 'conexion.php';

            if(isset($_GET['id'])){

                $producto_id = $_GET['id'];

                $stmt = $conexion->prepare("SELECT * FROM juego WHERE id = ? AND estado = 1");
                $stmt->bind_param("i", $producto_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();

                    $tipo = $row['tipo'];
                
        ?>

        <section class="product">
            <img src="<?php echo $row['link_imagen']; ?>" alt="logo-juego">
            <div class="product-info">
                <?php
                if (!empty($row['nombre_juego'])) {
                    ?><h2><?php echo $row['nombre_juego']; ?></h2><?php
                }
                ?>

                <?php
                if (!empty($row['version'])) {
                    ?><p>Version: <?php echo $row['version']; ?></p><?php
                }
                ?>

                <?php
                if (!empty($row['categoria'])) {
                    ?><p>Categoría: <?php echo $row['categoria']; ?></p><?php
                }
                ?>

                <?php
                if (!empty($row['desarrollador'])) {
                    ?><p>Desarrollador: <?php echo $row['desarrollador']; ?></p><?php
                }
                ?>

                <?php
                if (!empty($row['año_estreno'])) {
                    ?><p>Año de Estreno: <?php echo $row['año_estreno']; ?></p><?php
                }

                
                if ($loggedIn) {
                    ?><div class="links"><?php
                    if (!empty($row['link_descarga'])) {
                        ?><div class="botones_link"><a href="<?php echo $row['link_descarga']; ?>"><button>Obtener Ahora</button></a></div><?php
                    }
                    if (!empty($row['link_pagina_oficial'])) {
                        ?><div class="botones_link"><a href="<?php echo $row['link_pagina_oficial']; ?>"><button>Visitar Sitio Oficial</button></a></div><?php
                    }
                    
                    ?></div><?php
                }else{
                    echo "<br>NECESITAS INICIAR SESIÓN PARA DESCARGAR";
                }
                ?>                
            </div>
        </section>


        <?php


            $producto_actual = $producto_id;
            $sql_sidebar = "SELECT id, link_imagen, nombre_juego FROM juego WHERE id <> ? AND tipo = ? ORDER BY RAND() LIMIT 3";
            $stmt_sidebar = $conexion->prepare($sql_sidebar);
            $stmt_sidebar->bind_param("ii", $producto_actual, $tipo);
            $stmt_sidebar->execute();
            $resultado = $stmt_sidebar->get_result();
            $stmt_sidebar->close();
        ?>


        <aside class="sidebar_producto">
            <h2>Recomendaciones</h2>
            <div class="sidebar_responsive">
                <?php
                    if($resultado->num_rows > 0){  
                        while($row_sidebar = $resultado->fetch_assoc()){   
                            ?>

                            <div class="juego_recomendado">
                                <a href="detalle_producto.php?id=<?php echo $row_sidebar['id']; ?>">
                                    <img src="<?php echo $row_sidebar['link_imagen']; ?>" alt="logo_producto">
                                </a>
                                <a href="detalle_producto.php?id=<?php echo $row_sidebar['id']; ?>">
                                    <p><?php echo $row_sidebar['nombre_juego']; ?></p>
                                </a>
                            </div>

                            <?php
                        }
                    } else {
                        echo "No hay juegos recomendados disponibles.";
                    }
                                        
                    ?>
            </div>
        </aside>

        <?php
            $sql = "SELECT * FROM juego WHERE id = $producto_id";
            $result = $conexion->query($sql);
                    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <section class="description">
                    <?php

                        if (!empty($row['categoria'])) {
                            echo '<h3>Categoría:</h3><p>' . $row['categoria'] . '</p>';
                        }

                        if (!empty($row['desarrollador'])) {
                            echo '<h3>Desarrollador:</h3><p>' . $row['desarrollador'] . '</p>';
                        }

                        if (!empty($row['año_estreno'])) {
                            echo '<h3>Año de estreno:</h3><p>' . $row['año_estreno'] . '</p>';
                        }

                        if (!empty($row['descripcion']) ) {
                            echo '<br><h3>Descripción:</h3><p>' . $row['descripcion'] . '</p><br>';
                        }
                    
                        if (!empty($row['sistema_operativo']) && !empty($row['procesador']) && !empty($row['ram']) && !empty($row['targeta_grafica'])  && !empty($row['almacenamiento'])) {
                            echo '<h2>Especificaciones Recomendadas:<br><br></h2</p>';
                        
                    
                            if (!empty($row['sistema_operativo'])) {
                                echo '<h3>Sistema Operativo:</h3><p>' . $row['sistema_operativo'] . '</p>';
                            }

                            if (!empty($row['procesador'])) {
                                echo '<h3>Procesador:</h3><p>' . $row['procesador'] . '</p>';
                            }

                            if (!empty($row['ram'])) {
                                echo '<h3>Memoria RAM:</h3><p>' . $row['ram'] . '</p>';
                            }

                            if (!empty($row['targeta_grafica'])) {
                                echo '<h3>Tarjeta Gráfica:</h3><p>' . $row['targeta_grafica'] . '</p>';
                            }

                            if (!empty($row['almacenamiento'])) {
                                echo '<h3>Almacenamiento:</h3><p>' . $row['almacenamiento'] . '</p>';
                            }
                        }
                    ?>
                </section>
        <?php
            } else {
                echo "<h2>No se encontró información del producto.</h2>";
            }
            $stmt->close();
        
                    
                }else{
                    echo "<h2>Producto no encontrado.</h2>";
                }
            }else{
                echo "<h2>ID de producto no proporcionado.</h2>";
            }
        ?>
    </div>

    <?php 
        include 'layout/footer.php';
    ?>
</body>
</html>
