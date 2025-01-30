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


       <h1 class="texto1" style="text-align: center; font-weight: bold;">PERFIL DE ADMINISTRADOR</h1>


       <br><br>


       <div class="caixa-encomendas">

            <h4 class="texto1" style="color: #ddbc74; font-weight: bold;">ENCOMENDAS:</h4>


            <?php
                $stmt = $conn->prepare("SELECT * FROM encomendas");
                $stmt->execute();
                $result = $stmt->get_result();
            ?>

            <table class="admin-table1">
                <thead>
                    <tr>
                        <th>ID de utilizador</th>
                        <th>tipo de produto</th>
                        <th>nome</th>
                        <th>quantidade</th>
                        <th>preço total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $user_id = $row['userID'];
                                $tipo = $row['tipo'];
                                $nome = $row['nome'];
                                $quantidade = $row['quantidade'];
                                $total = $row['preçoTotal'];
                    
                                echo "<tr>";
                                echo "<td>$user_id</td>";
                                echo "<td>$tipo</td>";
                                echo "<td>$nome</td>";
                                echo "<td>$quantidade</td>";
                                echo "<td>$total</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Não existe nenhuma encomenda.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>

        </div>

        <br><br><br>

        <div class="caixa-produtos">

            <h4 class="texto1" style="color: #ddbc74; font-weight: bold;">PRODUTOS:</h4>

            <br>

            <h5 class="texto1">ANÉIS</h5>

            <?php
                $sql_aneis = "SELECT * FROM aneis ORDER BY ID";
                $result_aneis = $conn->query($sql_aneis);
            ?>

            <table class="admin-table1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>imagem</th>
                        <th>imagem - esgotado</th>
                        <th>nome</th>
                        <th>material</th>
                        <th>preço</th>
                        <th>stock</th>
                        <th>ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result_aneis->num_rows > 0) {
                            while ($row = $result_aneis->fetch_assoc()) {
                                $aneis_id = $row['ID'];
                                $img = $row['img'];
                                $img_stamp = $row['img_stamp'];
                                $nome = $row['nome'];
                                $material = $row['material'];
                                $preco = $row['preço'];
                                $stock = $row['stock'];

                                echo "<tr>";
                                echo "<td>$aneis_id</td>";
                                echo "<td>$img</td>";
                                echo "<td>$img_stamp</td>";
                                echo "<td>$nome</td>";
                                echo "<td>$material</td>";
                                echo "<form action='update_produto.php' method='POST'>";
                                echo "<input type='hidden' name='ID' value='$aneis_id'>";
                                echo "<input type='hidden' name='table_name' value='aneis'>";
                                echo "<td><input type='text' name='preço' value='$preco' style='text-align: center;' size='10'></td>";
                                echo "<td><input type='text' name='stock' value='$stock' style='text-align: center;' size='8'></td>";
                                echo "<td><input type='submit' class='swiper-button' value='guardar'></td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Não existem anéis.</td></tr>";
                        }
                    ?>
                    <td colspan='7'> <a href="adicionar_produto.php?tabela=aneis">ADICIONAR</a> </td>
                </tbody>
            </table>

            <br><br>

            <h5 class="texto1">BRINCOS</h5>
            
            <?php
                $sql_brincos = "SELECT * FROM brincos ORDER BY ID";
                $result_brincos = $conn->query($sql_brincos);
            ?>

            <table class="admin-table1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>imagem</th>
                        <th>imagem - esgotado</th>
                        <th>nome</th>
                        <th>material</th>
                        <th>preço</th>
                        <th>stock</th>
                        <th>ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result_brincos->num_rows > 0) {
                            while ($row = $result_brincos->fetch_assoc()) {
                                $brincos_id = $row['ID'];
                                $img = $row['img'];
                                $img_stamp = $row['img_stamp'];
                                $nome = $row['nome'];
                                $material = $row['material'];
                                $preco = $row['preço'];
                                $stock = $row['stock'];

                                echo "<tr>";
                                echo "<td>$brincos_id</td>";
                                echo "<td>$img</td>";
                                echo "<td>$img_stamp</td>";
                                echo "<td>$nome</td>";
                                echo "<td>$material</td>";
                                echo "<form action='update_produto.php' method='POST'>";
                                echo "<input type='hidden' name='ID' value='$brincos_id'>";
                                echo "<input type='hidden' name='table_name' value='brincos'>";
                                echo "<td><input type='text' name='preço' value='$preco' style='text-align: center;' size='10'></td>";
                                echo "<td><input type='text' name='stock' value='$stock' style='text-align: center;' size='8'></td>";
                                echo "<td><input type='submit' class='swiper-button' value='guardar'></td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Não existem brincos.</td></tr>";
                        }
                    ?>
                    <td colspan='7'> <a href="adicionar_produto.php?tabela=brincos">ADICIONAR</a> </td>
                </tbody>
            </table>

            <br><br>

            <h5 class="texto1">PULSEIRAS</h5>
            
            <?php
                $sql_pulseiras = "SELECT * FROM pulseiras ORDER BY ID";
                $result_pulseiras = $conn->query($sql_pulseiras);
            ?>

            <table class="admin-table1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>imagem</th>
                        <th>imagem - esgotado</th>
                        <th>nome</th>
                        <th>material</th>
                        <th>preço</th>
                        <th>stock</th>
                        <th>ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($result_pulseiras->num_rows > 0) {
                            while ($row = $result_pulseiras->fetch_assoc()) {
                                $pulseiras_id = $row['ID'];
                                $img = $row['img'];
                                $img_stamp = $row['img_stamp'];
                                $nome = $row['nome'];
                                $material = $row['material'];
                                $preco = $row['preço'];
                                $stock = $row['stock'];

                                echo "<tr>";
                                echo "<td>$pulseiras_id</td>";
                                echo "<td>$img</td>";
                                echo "<td>$img_stamp</td>";
                                echo "<td>$nome</td>";
                                echo "<td>$material</td>";
                                echo "<form action='update_produto.php' method='POST'>";
                                echo "<input type='hidden' name='ID' value='$pulseiras_id'>";
                                echo "<input type='hidden' name='table_name' value='pulseiras'>";
                                echo "<td><input type='text' name='preço' value='$preco' style='text-align: center;' size='10'></td>";
                                echo "<td><input type='text' name='stock' value='$stock' style='text-align: center;' size='8'></td>";
                                echo "<td><input type='submit' class='swiper-button' value='guardar'></td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Não existem pulseiras.</td></tr>";
                        }
                    ?>
                    <td colspan='7'> <a href="adicionar_produto.php?tabela=pulseiras">ADICIONAR</a> </td>
                </tbody>
            </table>

        </div>

        <br><br>