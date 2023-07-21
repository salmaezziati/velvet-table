<?php 
        include "../../../../connection.php";
        if(true) {
            $id = $_GET["id"];
            try {
                $checkItemExists = "select * from menu where id_menu = :id";
                $stmt = $pdo->prepare($checkItemExists);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $meal = $stmt->fetch();
                
                if($meal) {
                    $message = "are you sure";
                    echo "<script>onConfirm('$message', '$id')</script>";
                    
                    $message = "are you sure";
                    $query = "delete from menu where id_menu = :id";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(":id", $id);
                    $a = $stmt->execute();
                    echo "good";
                } else {
                    $message = "doesn't exists";
                    echo "<script>onConfirm()</script>";
                    // echo "bad";
                }
    
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        header("Location:./removeMeal.php");
    ?>