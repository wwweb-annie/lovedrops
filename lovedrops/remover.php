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

    $ID = $_POST['ID'];
    $table_name = $_POST['table_name'];

    if (isset($_SESSION['carrinho'][$table_name]) && isset ($_SESSION['carrinho'][$table_name][$ID])) {

        $stock = get_stock($conn, $table_name, $ID);
        $quantity = $_SESSION['carrinho'][$table_name][$ID];
        
        $newQuantity = $quantity - 1;
        $newStock = $stock + 1;

        $stmt = $conn->prepare("UPDATE $table_name SET stock = ? WHERE ID = ?");
        $stmt->bind_param("ii", $newStock, $ID);
        $stmt->execute();

        $_SESSION['carrinho'][$table_name][$ID] = $newQuantity;

    } else {
        echo "O item não está no carrinho.";
    }


    $stmt->close();
    $conn->close();

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
?>
