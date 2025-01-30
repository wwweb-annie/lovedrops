<?php
    session_start();
    
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $name_db = "lovedrops";

    $conn = new mysqli($servername, $username_db, $password_db, $name_db);

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    if ($_SESSION['username'] !== 'admin') {
        header("Location: login.php");
        exit();
    }

    $table_names = array(
        "aneis" => "anéis",
        "brincos" => "brincos",
        "pulseiras" => "pulseiras"
    );

    if (!isset($_GET['tabela'])) {
        echo "Tabela não especificada.";
        exit();
    }

    if (isset($_GET['tabela'])) {
        $tabela = $_GET['tabela'];
        if (array_key_exists($tabela, $table_names)) {
            $display_name = $table_names[$tabela];
        }
    } else {
        echo "Tabela não especificada.";
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">


    <head>

        <meta charset="UTF-8">

        <title>LOVE DROPS By Ana Reis</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
        
        <link href="css/css.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"> </script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"> </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"> </script>

        <script src="https://kit.fontawesome.com/058950bdca.js" crossorigin="anonymous"> </script>

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"> </script>

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

                                echo '<li class="nav-item3"> <a class="nav-link active" href="' . $profile . '">' . $username . '</a> </li>';
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

        <div class="caixa-registo">

            <h2 class="texto1" style="font-weight: bold;">adicionar <?php echo $display_name ?></h2>

            <br>

            <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $table = $_POST["table"];
                    $nome = $_POST['nome'];
                    $material = $_POST['material'];
                    $preço = str_replace(',', '.', $_POST["preço"]);
                    $stock = $_POST['stock'];

                    $imgPath = '';
                    $imgStampPath = '';

                    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
                        $img = $_FILES['img'];
                        $imgPath = '/lovedrops/img/' . basename($img['name']);
                        move_uploaded_file($img['tmp_name'], $imgPath);
                    }

                    if (isset($_FILES['img_stamp']) && $_FILES['img_stamp']['error'] == 0) {
                        $imgStamp = $_FILES['img_stamp'];
                        $imgStampPath = '/lovedrops/img/' . basename($imgStamp['name']);
                        move_uploaded_file($imgStamp['tmp_name'], $imgStampPath);
                    }
                
                    switch ($tabela) {
                        case "aneis":
                            $sql = "INSERT INTO aneis (img, img_stamp, nome, material, preço, stock) VALUES ('$imgPath', '$imgStampPath', '$nome', '$material', '$preço', '$stock')";
                            break;
                        case "brincos":
                            $sql = "INSERT INTO brincos (img, img_stamp, nome, material, preço, stock) VALUES ('$imgPath', '$imgStampPath', '$nome', '$material', '$preço', '$stock')";
                            break;
                        case "pulseiras":
                            $sql = "INSERT INTO pulseiras (img, img_stamp, nome, material, preço, stock) VALUES ('$imgPath', '$imgStampPath', '$nome', '$material', '$preço', '$stock')";
                            break;
                        default:
                            echo "Tabela não especificada.";
                            exit();
                    }
                
                    if ($conn->query($sql) === TRUE) {
                        echo "<p style='color: green; font-family: sofia2;'>produto adicionado com sucesso</p>";
                    } else {
                        echo "Erro ao adicionar a notícia: " . $conn->error;
                    }

                }

            ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?tabela=<?php echo $tabela; ?>" enctype="multipart/form-data">

                <input type="hidden" name="table" value="<?php echo $tabela; ?>">

                <label for="img" class="texto2" style="color: #ddbc74;"><b>imagem*:</b></label><br><br>
                <input type="file" id="img" name="img" style="text-align: justify;" required><br><br><br>

                <label for="img_stamp" class="texto2" style="color: #ddbc74;"><b>imagem esgotado*:</b></label><br><br>
                <input type="file" id="img_stamp" name="img_stamp" style="text-align: justify;" required><br><br><br>
                
                <label for="nome" class="texto2" style="color: #ddbc74;"><b>nome:</b></label><br>
                <textarea id="nome" name="nome" rows="1" cols="50" style="text-align: center;" required></textarea><br><br><br>
                
                <label for="material" class="texto2" style="color: #ddbc74;"><b>material:</b></label><br>
                <textarea id="material" name="material" rows="1" cols="50" style="text-align: center;" required></textarea><br><br><br>

                <label for="preço" class="texto2" style="color: #ddbc74;"><b>preço</b> com formato 0,00:</label><br>
                <input type="number" id="preço" name="preço" step="0.01" min="0" style="text-align: center;" required><br><br><br>

                <label for="stock" class="texto2" style="color: #ddbc74;"><b>stock:</b></label><br>
                <input type="number" id="stock" name="stock" min="1" style="text-align: center;" required></textarea><br><br><br>

                <button type="submit" class="btn">adicionar</button>

            </form>

            <br><br>

            <p class="texto2" style="color: #7F7F7F;">* as imagens têm de estar localizadas na pasta <i>img</i> da base de dados.</p>

            <p><a href="admin.php" class="texto2" style="color: #ddbc74;">voltar para a página de administrador</a></p>

        </div>

        <br><br>

    </body>


</html>