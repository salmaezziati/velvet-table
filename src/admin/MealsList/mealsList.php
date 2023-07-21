<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">

        <link
            rel="stylesheet"
            type="text/css"
            href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"
        />

        <?php
            $_SESSION["mealsList"] = "./mealsList.php";
            $_SESSION["ordersList"] = "../orderList/orderList.php";
            $_SESSION["reservationsList"] = "../reservationList/reservationList.php";
            $_SESSION["managementMeals"] = "../managementMeals/managementMeals.php";
            $_SESSION["addMeal"] = "../managementMeals/addMeal/addMeal.php";
            $_SESSION["removeMeal"] = "../managementMeals/removeMeal/removeMeal.php";
            $_SESSION["modifyMeal"] = "../managementMeals/checkMeal/checkMeal.php";
        ?>
        
</head>
<body>
    <?php
        $_SESSION["header_path"] = "../header/header.css"; 
        include "../header/header.php";
    ?>

    <?php 
        include "../../../connection.php";

        try{
            $sql = "SELECT * FROM menu";  
            $result = $pdo->query($sql);

            if($result->rowCount() > 0){
                echo "<div class='container'>";
                    echo "<table id='reservationList' class='table table-secondary table-hover table-striped mt-5'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>id</th>";
                                echo "<th>title</th>";
                                echo "<th>description</th>";
                                echo "<th>category</th>";
                                echo "<th>path_image</th>";
                                echo "<th>price</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "</tbody>";

                    while($row = $result->fetch()){
                        echo "<tr>";
                            echo "<td>" . $row['id_menu'] . "</td>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>" . $row['category'] . "</td>";
                            echo "<td>" . $row['path_image'] . "</td>";
                            echo "<td>" . $row['price'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                echo "</div>";
                // Free result set
                unset($result);
            } else{
                echo "No records matching your query were found.";
            }
        } catch(PDOException $e){
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
    ?>
    
    <script
        type="text/javascript"
        charset="utf8"
        src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"
    ></script>
    <script
        type="text/javascript"
        charset="utf8"
        src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"
    ></script>
    <script>
        $(function() {
            $("#reservationList").dataTable();
        });
    </script>
    
</body>
</html>
