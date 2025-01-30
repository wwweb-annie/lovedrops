<?php
    ob_start();
    session_start();

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

        <title>LOVE DROPS - Registo</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <link href="css/css.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"> </script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"> </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"> </script>

        <script src="https://kit.fontawesome.com/058950bdca.js" crossorigin="anonymous"> </script>
    
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
                            <div class="dropdown-menu w-auto">
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

                    <ul class="navbar-nav">

                        <li class="nav-item2">
                            <a class="nav-link" href="carrinho.php"><i class="fa-solid fa-cart-shopping"></i></a>
                        </li>

                    </ul>

                    <ul class="navbar-nav">

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
                                echo '<li class="nav-item3"> <a class="nav-link active" href="login.php">entrar</a> </li>';
                            }
                        ?>

                    </ul>
        
                </div>

            </div>

        </nav>


        <div class="caixa-registo">

            <h1 class="texto2" style="color: #ddbc74">R E G I S T O</h1>

            <br>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <span style="font-family: sofia2">nome:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="nome" name="nome" size="25" required><br><br>
                <span style="font-family: sofia2">morada:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="morada" name="morada" size="25" required><br><br>
                <span style="font-family: sofia2">data de nascimento:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="date" id="dataNasc" name="dataNasc" required><br><br>
                <span style="font-family: sofia2">e-mail:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="e-mail" name="e-mail" size="25" required><br><br>
                <span style="font-family: sofia2">username:&nbsp;&nbsp;&nbsp;</span> <input type="text" id="username" name="username" size="25" autocomplete="username" required><br><br>
                <span style="font-family: sofia2">password:&nbsp;&nbsp;&nbsp;</span> <input type="password" id="password" name="password" size="25" autocomplete="current-password" required><br><br>
                
                
                <button type="submit" class="btn"><b>registar</b></button>

            </form>

            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nome = $_POST['nome'];
                    $morada = $_POST['morada'];
                    $dataNasc = $_POST['dataNasc'];
                    $email = $_POST['e-mail'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
                    $currentDate = new DateTime();
                    $dateOfBirth = new DateTime($dataNasc);
                    $age = $currentDate->diff($dateOfBirth)->y;
                    
                    if ($age < 18) {
                        echo "<br><p style='color: red; font-family: sofia2;'><b>Atenção:</b> Deve ter pelo menos 18 anos para se registar.</p>";
                    } else {
                        $check_email_query = "SELECT * FROM utilizadores WHERE email = '$email'";
                        $check_email_result = $conn->query($check_email_query);
                        if ($check_email_result->num_rows > 0) {
                            echo "<br><p style='color: red;'><b>Erro:</b> O endereço de e-mail já se encontra registado.</p>";
                        } else {
                            $check_username_query = "SELECT * FROM utilizadores WHERE username = '$username'";
                            $check_username_result = $conn->query($check_username_query);
                            if ($check_username_result->num_rows > 0) {
                                echo "<br><p style='color: red; font-family: sofia2;'>O nome de utilizador já se encontra registado.</p>";
                            } else {
                                $sql = "INSERT INTO utilizadores (nome, morada, e-mail, dataNasc, username, password, usertype) VALUES ('$nome', '$morada', '$email', '$dataNasc', '$username', '$hashed_password', 'utilizador')";
                                if ($conn->query($sql) === TRUE) {
                                    header("Location: login.php");
                                    exit;
                                } else {
                                    echo "Erro ao registar: " . $conn->error;
                                }
                            }
                        }
                    }
                }
                $conn->close();
                ob_end_flush();
            ?>

        </div>
        

        <br>
        <div class="footer">

            <div class="footer-links">
                <a href="produtos.php" class="texto2">comprar</a>
                <br>
                <a href="faq.php" class="texto2">perguntas frequentes</a>
                <br>
                <a href="contactos.php" class="texto2">contactos</a>
            </div>

            <div class="footer-socials">
                <a href="https://www.facebook.com/profile.php?id=100063627157875" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/lovedrops1" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="mailto:lovedrops1969@gmail.com" target="_blank"><i class="fa-regular fa-envelope"></i></a>
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