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
?>


<!DOCTYPE html>
<html lang="en">


    <head>

        <meta charset="UTF-8">

        <meta name="description" content="Bijuteria de Autor - Love Drops: anéis, pulseiras, brincos, colares...">
        
        <title>LOVE DROPS - Carrinho</title>

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
                            <a class="nav-link" href="faq.php">perguntas frequentes</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="contactos.php">contactos</a>
                        </li>

                    </ul>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-right w-10">

                        <li class="nav-item2">
                            <a class="nav-link"  aria-current="page" href="carrinho.php"><i class="fa-solid fa-cart-shopping"></i></a>
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
        <h3 class="texto1" style="text-align: center; font-weight: bold;">O SEU CARRINHO</h3>
        <br><br>


        <?php

            if (isset($_GET['success']) && $_GET['success'] == 'true') {
                echo "<p style='font-size: 20px; font-family: sofia2; text-align: center; color: #54770d'>Compra realizada com sucesso!</p><p style='font-size: 20px; font-family: sofia2; text-align: center; color: #7F7F7F'>Por favor fique atento ao seu e-mail para escolher a sua forma de pagamento.<br>A equipa da <span style='color: #ddbc74; font-weight: bold;'>Love Drops</span> agradece!</p>";
            }

            if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
                if (!isset($_GET['success'])) {
                    echo "<p style='font-size: 20px; font-family: sofia2; text-align: center;'>O seu carrinho está vazio.<br><a href='produtos.php' style='color: #ddbc74;'>- continuar a comprar -</a></p>";
                }
            } else {

                foreach ($_SESSION['carrinho'] as $table_name => $item) {

                    foreach ($item as $ID => $quantity) {

                        $stmt = $conn->prepare("SELECT nome, img, preço FROM $table_name WHERE ID = ?");
                        $stmt->bind_param("i", $ID);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result && $result->num_rows > 0) {
                            $product = $result->fetch_assoc();

                            $stock = get_stock($conn, $table_name, $ID);
                            

                            echo "<div class='caixa-carrinho'>";
                            echo "<div class='carrinho-info1'>";
                            echo "<img class='carrinho-img' src='{$product['img']}' alt='{$product['nome']}' />";
                            echo "</div>";
                            echo "<div class='carrinho-info2'>";
                            echo "<p class='produto-nome'>{$product['nome']}</p>";
                            echo "</div>";
                            echo "<div class='carrinho-controlo'>";
                            echo "<p class='produto-preco'>{$product['preço']} EUR</p>";
                            if ($quantity >= 2) {
                                echo "<form action='remover.php' method='POST'>";
                                echo "<input type='hidden' name='ID' value='$ID'>";
                                echo "<input type='hidden' name='table_name' value='$table_name'>";
                                echo "<button type='submit' class='quantidade-btn' type='button'><b>-</b></button>";
                                echo "</form>";
                            } else {
                                echo "<button type='submit' class='quantidade-btn' style='cursor: not-allowed' disabled><b>-</b></button>";
                            }
                            echo "<span class='produto-quantidade'>$quantity</span>";
                            if ($stock >= 1) {
                                echo "<form action='adicionar.php' method='POST'>";
                                echo "<input type='hidden' name='ID' value='$ID'>";
                                echo "<input type='hidden' name='table_name' value='$table_name'>";
                                echo "<button type='submit' class='quantidade-btn'><b>+</b></button>";
                                echo "</form>";
                            } else {
                                echo "<button type='submit' class='quantidade-btn' style='cursor: not-allowed' title='não existe stock' disabled><b>+</b></button>";
                            }
                            echo "<form action='remover_tudo.php' method='POST' class='remover-form'>";
                            echo "<input type='hidden' name='ID' value='$ID'>";
                            echo "<input type='hidden' name='table_name' value='$table_name'>";
                            echo "<button class='remover-btn' type='submit'><i class='fas fa-trash'></i></button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            
                        }
                    }
                }

                $total = 0;

                foreach ($_SESSION['carrinho'] as $table_name => $item) {

                    foreach ($item as $ID => $quantity) {

                        $stmt = $conn->prepare("SELECT preço FROM $table_name WHERE ID = ?");
                        $stmt->bind_param("i", $ID);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result && $result->num_rows > 0) {
                            $product = $result->fetch_assoc();
                            $total += $product['preço'] * $quantity;
                        }
                    }
                }
            }
        ?>


        <?php
            if (!empty($_SESSION['carrinho'])) {
        ?>

        <div class="caixa-carrinho">
            <div class="carrinho-info2">
                <span class='produto-preco' style='font-size: 20px; font-family: sofia1;'><b>total:</b></span>
            </div>
            <div class="carrinho-controlo">
                <span class='produto-preco' style='font-size: 20px; font-family: sofia2; text-align: right;'> <?php echo number_format($total, 2); ?> EUR</span>
            </div>
        </div>
        <br>
        <div class="caixa-carrinho" style="border: none;">
            <div class="carrinho-controlo">
                <form action='comprar.php' method='POST' class='comprar'>
                    <input type="hidden" id="userID" name="userID" value="<?php echo $_SESSION['userID']; ?>" required>
                    <input type="hidden" id="produtos" name="produtos" value="<?php echo $_SESSION['carrinho']; ?>" required>
                    <button type='submit' class='swiper-button'>comprar</button>
                </form>
            </div>
        </div>

        <?php
            } else { echo '<br>'; }
            $conn->close();
        ?>


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