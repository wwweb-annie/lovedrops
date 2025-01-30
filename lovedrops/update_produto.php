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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ID = $_POST['ID'];
        $preco = $_POST['preço'];
        $stock = $_POST['stock'];
        $table_name = $_POST['table_name'];
    

        $ID = filter_var($ID, FILTER_SANITIZE_NUMBER_INT);
        $preco = filter_var($preco, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $stock = filter_var($stock, FILTER_SANITIZE_NUMBER_INT);
    
        if ($ID && $preco !== false && $stock !== false) {
            $sql_update = "UPDATE $table_name SET preço=?, stock=? WHERE ID=?";
            $stmt = $conn->prepare($sql_update);
            $stmt->bind_param("sii", $preco, $stock, $ID);
    
            if ($stmt->execute()) {
                echo "Porduto atualizado com sucesso.";
            } else {
                echo "Erro: " . $conn->error;
            }
    
            $stmt->close();
        } else {
            echo "Input inválido.";
        }
    
        $conn->close();
    }
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();

?>