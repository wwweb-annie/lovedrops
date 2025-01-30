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

    $ID = $_POST['ID'];
    $table_name = $_POST['table_name'];

    $stmt = $conn->prepare("SELECT stock FROM $table_name WHERE ID = ?");
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        $currentStock = $product['stock'];
        $quantity = 1;

        if ($currentStock >= $quantity) {
            $newStock = $currentStock - $quantity;
            $stmt = $conn->prepare("UPDATE $table_name SET stock = ? WHERE ID = ?");
            $stmt->bind_param("ii", $newStock, $ID);
            $stmt->execute();

            if (!isset($_SESSION['carrinho'])) {
                $_SESSION['carrinho'] = array();
            }

            if (!isset($_SESSION['carrinho'][$table_name])) {
                $_SESSION['carrinho'][$table_name] = array();
                $_SESSION['carrinho'][$table_name][$ID] = $quantity;
            } else {
                $_SESSION['carrinho'][$table_name][$ID] += $quantity;
            }

        } else {
            $_SESSION['cart-message'] = "Não existe stock disponível.";
        }
    } else {
        echo "Este produto não existe.";
    }

    $stmt->close();
    $conn->close();

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
?>
