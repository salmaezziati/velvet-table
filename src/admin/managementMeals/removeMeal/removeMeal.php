<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./removeMeal.css">

    
    <?php
        $_SESSION["mealsList"] = "../../MealsList/mealsList.php";
        $_SESSION["ordersList"] = "../../orderList/orderList.php";
        $_SESSION["reservationsList"] = "../../reservationList/reservationList.php";
        $_SESSION["addMeal"] = "../addMeal/addMeal.php";
        $_SESSION["removeMeal"] = "../removeMeal/removeMeal.php";
        $_SESSION["modifyMeal"] = "../checkMeal/checkMeal.php";
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
        include "../../../../connection.php";
        if(isset($_POST["confirm"])) {
            $id = $_POST["id"];
            try {
                $checkItemExists = "select * from menu where id_menu = :id";
                $stmt = $pdo->prepare($checkItemExists);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
                $meal = $stmt->fetch();
                
                if(true) {                    
                    echo "
                        <script> 
                            var meal = ". json_encode($meal) .";
                            var id = ". json_encode($id) .";
                            console.log(id);
                            if(meal) {
                                console.log(meal);
                                Swal.fire({
                                    title: 'Confirmation',
                                    text: 'Are you sure you want to delete this item?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Delete',
                                    cancelButtonText: 'Cancel'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = './completeOperation.php?id=' + $id;
                                    } else {
                                    }                                       
                                });                            
                            } else if(id != '') {
                                Swal.fire({
                                    title: 'Confirmation',
                                    text: 'doesn t exists',
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok',
                                    cancelButtonText: 'Cancel'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                    }
                                });
                            }
                            id = null;
                            meal = null;
                        </script>
                        ";
                        unset($id);
                        unset($meal);
                        $meal = null;
                        $_POST['id'] = "";
                } else {}
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    ?>

    <?php
        $_SESSION["header_path"] = "../../header/header.css";
        include_once "../../header/header.php";
    ?>


    <main class="container">
        <form method="POST" class="p-5">
            <div>
                <label class="form-label" for="identification">Identification</label>
                <input required pattern="^\d+$" name="id" type="text" id="identification" class="form-control">
            </div>
            <div class="mt-2">
                <button name="confirm" class="me-1 btn btn-success" type="submit">Confirm</button>
            </div>
        </form>
    </main>
</body>