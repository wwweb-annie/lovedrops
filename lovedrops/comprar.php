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

    if ($_SESSION['loggedin'] !== true) {
        header("Location: login.php");
        exit();
    }

    $userID = $_SESSION['userID'];

    foreach ($_SESSION['carrinho'] as $table_name => $item) {

        foreach ($item as $ID => $quantity) {

            $stmt = $conn->prepare("SELECT nome, preço FROM $table_name WHERE ID = ?");
            $stmt->bind_param("i", $ID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $preco = $row['preço'];
            $nome = $row['nome'];

            $precoTotal = $preco * $quantity;

            $stmt = $conn->prepare("INSERT INTO encomendas (userID, tipo, nome, quantidade, preçoTotal) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issis", $userID, $table_name, $nome, $quantity, $precoTotal);
            $stmt->execute();

        }
    }

    unset($_SESSION['carrinho']);

    $stmt->close();
    $conn->close();

    header("Location: carrinho.php?success=true");
    exit();

?>
