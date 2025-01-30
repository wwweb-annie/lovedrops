<?php
    session_start();

    include 'funcao_global.php';

    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $name_db = "lovedrops";

    $conn = new mysqli($servername, $username_db, $password_db, $name_db);

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    function get_img($table_name, $ID) {
        global $conn;
        
        $sql_img = "SELECT img, img_stamp, nome, stock FROM $table_name WHERE ID = $ID";
        $result_img = $conn->query($sql_img);
        if ($result_img->num_rows > 0) {
            $row = $result_img->fetch_assoc();
            $nome = $row['nome'];
            $stock = $row['stock'];
            $img = $row['img'];
            $img_stamp = $row['img_stamp'];

            if ($stock == 0) {
                echo "<img src='$img_stamp' class='swiper-img'>";
            } else {
                echo "<img src='$img' class='swiper-img'>";
            }

            return $stock;
        }
    }

    function get_nome($table_name, $ID) {
        global $conn;
        
        $sql_nome = "SELECT nome FROM $table_name WHERE ID = $ID";
        $result_nome = $conn->query($sql_nome);
        if ($result_nome->num_rows > 0) {
            $row = $result_nome->fetch_assoc();
            $nome = $row['nome'];

            echo $nome;

            return $nome;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">


    <head>

        <meta charset="UTF-8">
                
        <meta name="description" content="Bijuteria de Autor - Love Drops: anéis, pulseiras, brincos, colares...">

        <title>LOVE DROPS - Produtos</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <link href="css/css.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"> </script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"> </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"> </script>

        <script src="https://kit.fontawesome.com/058950bdca.js" crossorigin="anonymous"> </script>

        <script src="mainjs/js.js"> </script>

        
        
    </head>

    
    <body>


        <nav class="navbar navbar-expand-lg navbar-light sticky-top">

            <div class="container-fluid">

                <a class="navbar-brand mx-auto" href="home.php">
                    <img src="img/logo.png" alt="Logo Love Drops" width="200" class="d-inline-block align-center">
                </a>
        
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"> </span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-center w-100">

                        <li class="nav-item">
                            <a class="nav-link" href="home.php">home</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a href="produtos.php" class="nav-link dropdown-toggle" id="navbardrop">
                                produtos
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="produtos.php">&nbsp;&nbsp;NOVA COLEÇÃO</a>
                                <a class="dropdown-item" href="produtos.php">&nbsp;&nbsp;anéis</a>
                                <a class="dropdown-item" href="produtos.php">&nbsp;&nbsp;brincos</a>
                                <a class="dropdown-item" href="produtos.php">&nbsp;&nbsp;colares</a>
                                <a class="dropdown-item" href="produtos.php">&nbsp;&nbsp;pulseiras</a>
                                <a class="dropdown-item" href="produtos.php">&nbsp;&nbsp;acessórios</a>
                                <a class="dropdown-item" href="produtos.php">&nbsp;&nbsp;pendentes</a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link"href="faq.php">perguntas frequentes</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="contactos.php">contactos</a>
                        </li>

                    </ul>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-right w-10">

                        <li class="nav-item2">
                            <a class="nav-link" href="carrinho.php"><i class="fa-solid fa-cart-shopping"></i></a>
                        </li>

                    </ul>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-right w-10">

                        <?php
                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                $username = $_SESSION['username'];
                                $usertype = $_SESSION['usertype'];

                                if ($usertype === 'admin') {
                                    $profile = 'admin.php';
                                } else {
                                    $profile = 'carrinho.php';
                                }

                                echo '<li class="nav-item3"> <a class="nav-link" href="' . $profile . '">' . $username . '</a> </li>';
                                echo '<li class="nav-item4"> <a class="nav-link" href="logout.php"> <i class="fa-solid fa-arrow-right-from-bracket"></i> </a> </li>';
                            } else {
                                echo '<li class="nav-item3"> <a class="nav-link" href="login.php">entrar</a> </li>';
                            }
                        ?>

                    </ul>
        
                </div>

            </div>

        </nav>


        <br>
        <h3 class="texto1" style="text-align: center; font-weight: bold;">PRODUTOS</h3>
        <br><br>


        <div class="row">

            <div class="col-sm-3">

                <div class="card">

                    <div class="card-img">
                        <?php get_img('aneis', 1); ?>
                    </div>
                    <div class="card-title" style="font-family: sofia2">
                        <?php get_nome('aneis', 1); ?>
                    </div>
                    <?php get_botao($conn, 'aneis', 1); ?>

                </div>

            </div>

            <div class="col-sm-3">

                <div class="card">

                    <div class="card-img">
                        <?php get_img('aneis', 2); ?>
                    </div>
                    <div class="card-title" style="font-family: sofia2">
                        <?php get_nome('aneis', 2); ?>
                    </div>
                    <?php get_botao($conn, 'aneis', 2); ?>

                </div>

            </div>

            <div class="col-sm-3">

                <div class="card">

                    <div class="card-img">
                        <?php get_img('aneis', 3); ?>
                    </div>
                    <div class="card-title" style="font-family: sofia2">
                        <?php get_nome('aneis', 3); ?>
                    </div>
                    <?php get_botao($conn, 'aneis', 3); ?>

                </div>

            </div>

            <div class="col-sm-3">

                <div class="card">

                    <div class="card-img">
                        <?php get_img('aneis', 4); ?>
                    </div>
                    <div class="card-title" style="font-family: sofia2">
                        <?php get_nome('aneis', 4); ?>
                    </div>
                    <?php get_botao($conn, 'aneis', 4); ?>

                </div>

            </div>

        </div>


        <br>


        <div class="row">

            <div class="col-sm-3">

                <div class="card">

                    <div class="card-img">
                        <?php get_img('pulseiras', 1); ?>
                    </div>
                    <div class="card-title" style="font-family: sofia2">
                        <?php get_nome('pulseiras', 1); ?>
                    </div>
                    <?php get_botao($conn, 'pulseiras', 1); ?>

                </div>

            </div>

            <div class="col-sm-3">

                <div class="card">

                    <div class="card-img">
                        <?php get_img('pulseiras', 2); ?>
                    </div>
                    <div class="card-title" style="font-family: sofia2">
                        <?php get_nome('pulseiras', 2); ?>
                    </div>
                    <?php get_botao($conn, 'pulseiras', 2); ?>

                </div>

            </div>

            <div class="col-sm-3">

                <div class="card">

                    <div class="card-img">
                        <?php get_img('brincos', 1); ?>
                    </div>
                    <div class="card-title" style="font-family: sofia2">
                        <?php get_nome('brincos', 1); ?>
                    </div>
                    <?php get_botao($conn, 'brincos', 1); ?>

                </div>

            </div>

            <div class="col-sm-3">

                <div class="card">

                    <div class="card-img">
                        <?php get_img('brincos', 2); ?>
                    </div>
                    <div class="card-title" style="font-family: sofia2">
                        <?php get_nome('brincos', 2); ?>
                    </div>
                    <?php get_botao($conn, 'brincos', 2); ?>

                </div>

            </div>

        </div>

        
        <br><br>


        <div class="footer">

            <div class="footer-links">
                <a href="produtos.php" class="texto2">comprar</a>
                <br>
                <a href="faq.php" class="texto2">perguntas frequentes</a>
                <br>
                <a href="contactos.php" class="texto2">contactos</a>
            </div>

            <div class="footer-socials">
                <a href="https://www.facebook.com/profile.php?id=100063627157875"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/lovedrops1"><i class="fa-brands fa-instagram"></i></a>
                <a href="mailto:lovedrops1969@gmail.com"><i class="fa-regular fa-envelope"></i></a>
            </div>

            <div class="newsletter">
                <h6 class="texto1" style="color: white; font-weight: bold;">subscreva à newsletter mensal <br> e não perca nenhuma novidade!</h6>
                <form action="#" method="POST">
                <input type="email" name="email" class="newsletter-input" placeholder="o seu email aqui">
                <button type="submit" class="newsletter-btn">subscrever</button>
                </form>
            </div>

        </div>
        

    </body>


</html>