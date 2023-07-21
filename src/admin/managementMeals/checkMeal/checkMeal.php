<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./checkMeal.css">
    
    
    <?php 
        include "../../../../connection.php";
        if(isset($_POST["confirmItem"])) {
            $id = $_POST["id"];
            
            try{
                $query = "select * from menu where id_menu = :id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                
                $meal = $stmt->fetch();
                
                if($meal) {
                    $jsonData = json_encode($meal);
                    $encodedData = base64_encode($jsonData);
                    $url = "Location:../modifyMeal/modifyMeal.php?meal=" . urlencode($encodedData);
                    header($url);
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        ?>

    <?php
        $_SESSION["mealsList"] = "../../MealsList/mealsList.php";
        $_SESSION["ordersList"] = "../../orderList/orderList.php";
        $_SESSION["reservationsList"] = "../../reservationList/reservationList.php";
        $_SESSION["managementMeals"] = $_SERVER["PHP_SELF"];         
        $_SESSION["addMeal"] = "../addMeal/addMeal.php";
        $_SESSION["removeMeal"] = "../removeMeal/removeMeal.php";
        $_SESSION["modifyMeal"] = $_SERVER["PHP_SELF"];
    ?>

    <?php 
        $_SESSION["errorIcon"] = "../../../../assets/icon_alert/error.png";
        $_SESSION["warningIcon"] = "../../../../assets/icon_alert/warning.png";
        $_SESSION["successIcon"] = "../../../../assets/icon_alert/success.png";
        $_SESSION["backgroundDarker"] = "../../../helpers/backgroundDarker.php";
        include "../../../helpers/alert.php";
    ?>
</head>
<body>

    <?php
        $_SESSION["header_path"] = "../../header/header.css";
        include_once "../../header/header.php";
    ?>
    
    <div class="container">
        <form method="POST" class="p-5">            
            <div class="form-group">
                <label class="form-label">Identification</label>
                <input name="id" class="form-control" />
            </div>
            <div class="mt-2">
                <button name="confirmItem" class="me-1 btn btn-success">Confirm</button>
                <button type="button" onclick="sweetAlert('warning')" class="me-1 btn btn-danger">Cancel</button>
            </div>
        </form>
    </div>


</body>
</html>