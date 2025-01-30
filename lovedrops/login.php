<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $servername = "localhost";
        $username_db = "root";
        $password_db = "";
        $name_db = "lovedrops";

        $conn = new mysqli($servername, $username_db, $password_db, $name_db);

        if ($conn->connect_error) {
            die("Erro na conexão: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT userID, password, usertype, nome, morada FROM utilizadores WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $login_error = "";

        if (!$result) {
            die("Erro na consulta SQL: " . $conn->error);
        }

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hashed_password_db = $row['password'];
        
            if (password_verify($password, $hashed_password_db)) {
                $usertype = $row['usertype'];
                $userID = $row['userID'];
                $nome = $row['nome'];
                $morada = $row['morada'];
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['usertype'] = $usertype;
                $_SESSION['userID'] = $userID;
                $_SESSION['nome'] = $nome;
                $_SESSION['morada'] = $morada;
                if ($usertype === 'utilizador') {
                    header("Location: carrinho.php");
                    exit();
                } 
                elseif ($usertype === 'admin') {
                    header("Location: admin.php");
                    exit();
                } else {
                    $login_error = "<span style='color: red; font-family: sofia2;'><br><b>Atenção:</b> Algo correu mal. Contacte o administrador.</span>";
                }
            }  else {
                $login_error = "<span style='color: red; font-family: sofia2;'><br>Nome de utilizador ou senha incorretos.</span>";
            }
        } else {
            $login_error = "<span style='color: red; font-family: sofia2;'><br><b>Nome de utilizador inexistente.</span>";
        }

        $stmt->close();
        $conn->close();
    }
?>


<!DOCTYPE html>
<html lang="en">


    <head>

        <meta charset="UTF-8">
                
        <meta name="description" content="Bijuteria de Autor - Love Drops: anéis, pulseiras, brincos, colares...">

        <title>LOVE DROPS - Login</title>

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

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-right w-10">

                        <li class="nav-item2">
                            <a class="nav-link" href="carrinho.php"><i class="fa-solid fa-cart-shopping"></i></a>
                        </li>

                    </ul>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-right w-10">

                        <li class="nav-item3">
                            <a class="nav-link active" aria-current="page" style="color: #e2cc9c;" href="login.php"><b>entrar</b></a>
                        </li>

                    </ul>
        
                </div>

            </div>

        </nav>


        <div class="caixa-login">

            <h1 class="texto2" style="color: #ddbc74">L O G I N</h1>

            <br><br>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">

                <label for="username" style="font-family: sofia2">utilizador:&nbsp;</label>
                <input type="text" id="username" name="username" required><br><br>

                <label for="password" style="font-family: sofia2">password:&nbsp;</label>
                <input type="password" id="password" name="password" required><br><br>

                <button type="submit" class="btn" style="font-family: sofia2"><b>entrar</b></button>

            </form>

            <?php echo isset($login_error) ? $login_error : ''; ?>

            <br><br>

            <p style="font-size: 15px; font-family: sofia2">Não está registado? <a href="registo.php" style="color: #ddbc74">Registe-se aqui!</a></p>

            <br><br>

        </div>


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