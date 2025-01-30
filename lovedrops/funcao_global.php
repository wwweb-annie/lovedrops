<?php

    function get_stock($conn, $table_name, $ID) {
        $sql_stock = "SELECT stock FROM $table_name WHERE ID = $ID";
        $sql_result = $conn->query($sql_stock);

        if ($sql_result->num_rows > 0) {
            $row = $sql_result->fetch_assoc();
            $stock = $row['stock'];

            return $stock;
        }

        return 0;
    }


    function get_botao($conn, $table_name, $ID) {

        $stock = get_stock($conn, $table_name, $ID);

        echo "<form action='adicionar.php' method='POST'>";
        echo "<input type='hidden' name='ID' value='$ID'>";
        echo "<input type='hidden' name='table_name' value='$table_name'>";
        
        if ($stock == 0) {
            echo "<button type='submit' class='swiper-button' style='cursor: not-allowed' disabled>adicionar ao carrinho</button>";
        } else {
            echo "<button type='submit' class='swiper-button'>adicionar ao carrinho</button>";
        }

        echo "</form>";

        return $stock;
    }


?>