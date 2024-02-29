<?php 
    session_start();
    $loggedin = $_SESSION['loggedin'];
?>

<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;

    }

    body.no-scroll {
        overflow: hidden;
    }

    header{
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 2rem;
        background-color: #D5DBDB;
        top: 0;
        max-height: 65px;
    }

    header img{
        width: 55px;
        transition: all 300ms ease;
    }

    header img:hover{
        transform: scale(1.1);
    }


    h1{
        color: #283747;
    }

    .nav-list{
        list-style: none;
        display: flex;
        gap: 2rem;
        padding-bottom: 20px;
    }

    .nav-list li a{
        text-decoration: none;
        color: #283747;
        font-size: 22px;
        padding-right: 22px;
        padding-bottom: 20px;
    }

    .nav-list li a i{
        transition: all 300ms ease;
        padding-bottom: 20px;
    }

    .nav-list li a i:hover{
        transform: scale(1.2);
        color: #3EC483;
    }

    .abrir,
    .cerrar{
        display: none;
    }

    .img_perfil{
        display: flex;
        align-items: center;
    }

    .img_perfil li a img{
        width: 55px;
        border-radius: 50%;
        top: -50px;
    }


    @media (max-width: 768px) {
        .abrir,
        .cerrar{
            display: block;
            border: 0;
            font-size: 30px;
            background-color: #D5DBDB;
        }

        header{
            padding: 1rem;
        }


        .nav{
            opacity: 0;
            visibility: hidden;
            display: flex;
            flex-direction: column;
            align-items: end;
            gap: 1rem;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            background-color: #D5DBDB;
            padding: 2rem;
            box-shadow: 0 0 0 100vmax rgba(0, 0, 0, .5);
            opacity: 1;
        }

        .nav.visible{
            opacity: 1;
            visibility: visible;
        }

        .nav-list{
            flex-direction: column;
            align-items: end;
            padding-right: 0;
            padding-bottom: 0;
        }

        .nav-list a {
            background-color: #D5DBDB;
            padding-bottom: 0;
        }

        .nav-list li a{
            padding-right: 0;
            padding-bottom: 0;
        }

        .menuAutenticado{
            display: flex;
        }
    }
</style>

<header>
    <a href="index.php" class="logo_header"><img src="img/Mountain-logo-Design-Graphics-9785421-1.png" alt="logo"></a>
        <h1>Runplay Store</h1>
        <button class="abrir" id="abrir"><i class="fa-solid fa-bars"></i></button>
        <nav class="nav" id="nav">
            <button class="cerrar" id="cerrar"><i class="fa-solid fa-xmark"></i></button><br><br>
            <ul class="nav-list">
                <li><a href="index.php"><i class="fa-solid fa-house fa-lg"></i></a></li>
                <li><a href="buscar.php"><i class="fa-solid fa-magnifying-glass fa-lg"></i></a></li>
                <li><a href="contactos.php"><i class="fa-solid fa-envelope fa-lg"></i></a></li>
                        <?php if ($loggedin) :

                            include '../conexion.php';
                            $id_user = $_SESSION['user_id'];
                            $sql1 = "SELECT * FROM img_perfil WHERE id_user = $id_user";
                            $stmt1 = $conexion->prepare($sql1);
                            $stmt1->execute();
                            $result = $stmt1->get_result();

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                if (!empty($row['id_user']) && $row['id_user'] == $id_userr) {
                                    ?>
                                    <div class="img_perfil">
                                        <li><a href="perfil.php"><?php echo '<img src="data:' . $row["tipo"] . ';base64,' . base64_encode($row["dato"]) . '" alt="Imagen" loading="lazy">'; ?></a></li>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                        <li><a href="perfil.php"><i class="fa-solid fa-user fa-lg"></i></a></li>
                                    <?php
                                }
                            }else{
                                ?>
                                    <li><a href="perfil.php"><i class="fa-solid fa-user fa-lg"></i></a></li>
                                <?php
                            }

                            $sql2 = "SELECT puesto FROM usuarios WHERE id = $id_user";
                            $stmt2 = $conexion->prepare($sql2);
                            $stmt2->execute();
                            $result = $stmt2->get_result();

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                if (!empty($row['puesto']) && $row['puesto'] == "admin") {
                                    ?>
                                        <li><a href="crud/principal.php"><i class="fa-solid fa-pen-to-square fa-lg"></i></a></li>
                                    <?php
                                }
                            }
                            ?>
                            
                            <li><a href="configuracion.php"><i class="fa-solid fa-cog fa-lg"></i></a></li>
                            <li><a href="logout.php"><i class="fa-solid fa-sign-out-alt fa-lg"></i></a></li>
                        <?php else : ?>
                            <li><a href="login.php"><i class="fa-solid fa-user fa-lg"></i></a></li>
                        <?php endif; ?>
            </ul>
        </nav>
    </header>

<script>
   const nav = document.querySelector("#nav");
    const abrir = document.querySelector("#abrir");
    const cerrar = document.querySelector("#cerrar");
    const body = document.body;

    abrir.addEventListener("click", () => {
        nav.classList.add("visible");
        body.classList.add("no-scroll");
    });

    cerrar.addEventListener("click", () => {
        nav.classList.remove("visible");
        body.classList.remove("no-scroll");
    });

    // Cierra el menú si se hace clic fuera de él
    window.addEventListener("click", (event) => {
        if (!nav.contains(event.target) && !abrir.contains(event.target)) {
            nav.classList.remove("visible");
            body.classList.remove("no-scroll");
        }
    });

</script>