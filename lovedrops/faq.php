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
?>


<!DOCTYPE html>
<html lang="en">


    <head>

        <meta charset="UTF-8">
                
        <meta name="description" content="Bijuteria de Autor - Love Drops: anéis, pulseiras, brincos, colares...">

        <title>LOVE DROPS - FAQ</title>

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
                            <a class="nav-link active" aria-current="page" style="color: #e2cc9c;" href="faq.php"><b>perguntas frequentes</b></a>
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


        <h1 class="texto1" style="text-align: center; font-weight: bold;">PERGUNTAS FREQUENTES</h1>


        <br><br>


        <div id="accordion">

            <div class="card1">
                <div class="card-header mb-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="text-indent: 50px; font-family: sofia2;">
                   ◦&nbsp;&nbsp;&nbsp;Quanto custam os portes? E quando são enviadas as encomendas?
                </div>
          
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <p style="text-indent: 50px; font-family: sofia2;">Fazemos envios apenas através dos <b>CTT</b>, em correio verde ou registado, a escolher no momento da compra.</p>
                        <p style="text-indent: 50px; font-family: sofia2;">Ambos têm um custo fixo de 4€. Oferecemos os portes em encomendas a partir dos 30€.</p>
                        <p style="text-indent: 50px; font-family: sofia2;">As encomendas são enviadas para Portugal Continental, Ilhas e Europa no máximo 2 dias úteis após realizado o pagamento.</p>
                        <p style="text-indent: 50px; font-family: sofia2;"><b>Não realizamos envios à cobrança e não nos responsabilizamos por extravios por parte dos CTT.</b></p>
                    </div>
                </div>
            </div>

            <div class="card1">
                <div class="card-header mb-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="text-indent: 50px; font-family: sofia2;">
                    ◦&nbsp;&nbsp;&nbsp;Como efetuo o pagamento?
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body" style="text-indent: 50px; font-family: sofia2;">
                        <p>
                        O pagamento é efetuado através de MBWay, Transferência Bancária ou PayPal.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card1">
                <div class="card-header mb-0" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree" style="text-indent: 50px; font-family: sofia2;">
                    ◦&nbsp;&nbsp;&nbsp;Como faço uma troca ou devolução? Recebo reembolso?
                </div>

                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <p style="text-indent: 50px; font-family: sofia2;">Para fazer um pedido de troca ou devolução deve enviar-nos uma mensagem pelos meios indicados na página de <a href="contactos.php" target="_blank" style="color: #ddbc74;">contactos</a>.</p>
                        <p style="text-indent: 50px; font-family: sofia2;">As devoluções e respetivo reembolso apenas são efetuados quando se verifica um defeito na peça por motivos alheios ao cliente.</p>                    
                        <p style="text-indent: 50px; font-family: sofia2;"><b>Não aceitamos devoluções de peças personalizadas ou feitas por medida.</b></p>
                    </div>
                </div>
            </div>

            <div class="card1">
                <div class="card-header mb-0" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour" style="text-indent: 50px; font-family: sofia2;">
                    ◦&nbsp;&nbsp;&nbsp;Quais são os tamanhos das peças e como garanto que me sirvam?
                </div>

                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body">
                        <p style="text-indent: 50px; font-family: sofia2;">Todas as peças têm o devido tamanho indicado na descrição de cada uma. Os anéis são todos <b>ajustáveis</b>.</p>
                        <p style="text-indent: 50px; font-family: sofia2;">Caso tenha uma peça que necessite de ajuste no tamanho, contacte-nos pelos meios indicados na página de <a href="contactos.php" target="_blank" style="color: #ddbc74;">contactos</a> <u>antes</u> de realizar a sua encomenda.</p>
                    </div>
                </div>
            </div>

            <div class="card1">
                <div class="card-header mb-0" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive" style="text-indent: 50px; font-family: sofia2;">
                    ◦&nbsp;&nbsp;&nbsp;Quais são os materiais das peças Love Drops?
                </div>

                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body">
                        <p style="text-indent: 50px; font-family: sofia2;">Todas as peças têm o devido material indicado na descrição de cada uma. Usamos maioritariamente Aço Inoxidável, Hematite, Cristais Checos ou Pérolas naturais.</p>
                        <p style="text-indent: 50px; font-family: sofia2;">O Aço Inoxidável é hipoalergénico, resistente à água e não enferruja.</p>
                        <p style="text-indent: 50px; font-family: sofia2;">Embora apenas usemos produtos de alta qualidade e durabilidade, mantenha sempre o cuidado com as suas peças, especialmente evitando o contacto com produtos químicos ou até suor.</p>
                    </div>
                </div>
            </div>

            <div class="card1">
                <div class="card-header mb-0" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix" style="text-indent: 50px; font-family: sofia2;">
                    ◦&nbsp;&nbsp;&nbsp;Como devo guardar as minhas peças Love Drops?
                </div>

                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                    <div class="card-body">
                        <p style="text-indent: 50px; font-family: sofia2;">Independentemente dos materiais das suas peças, recomendamos que as guarde num compartimento individual e macio para evitar riscos, fresco e seco, sem contacto direto com a luz solar.</p>
                    </div>
                </div>
            </div>

            <div class="card1">
                <div class="card-header mb-0" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven" style="text-indent: 50px; font-family: sofia2;">
                    ◦&nbsp;&nbsp;&nbsp;As peças têm garantia?
                </div>

                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                    <div class="card-body">
                        <p style="text-indent: 50px; font-family: sofia2;">Todas as peças Love Drops têm uma garantia de <b>1 ano.</b></p>
                        <p style="text-indent: 50px; font-family: sofia2;">A garantia é ativada apenas quando se verifica que os danos são alheios ao cliente.</p>
                    </div>
                </div>
            </div>

            <div class="card1">
                <div class="card-header mb-0" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight" style="text-indent: 50px; font-family: sofia2;">
                    ◦&nbsp;&nbsp;&nbsp;Onde fica localizada a loja Love Drops?
                </div>

                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                    <div class="card-body">
                        <p style="text-indent: 50px; font-family: sofia2;">De momento não temos loja física e trabalhamos apenas Online.</p>
                        <p style="text-indent: 50px; font-family: sofia2;">Temos parcerias na zona de Coimbra onde consegue comprar peças Love Drops presencialmente. Para mais informações contacte-nos pelos meios indicados na página de <a href="contactos.php" target="_blank" style="color: #ddbc74;">contactos</a>.</p>
                    </div>
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