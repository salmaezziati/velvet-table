<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../../bootstrap/css/bootstrap.rtl.css">
    <link rel="stylesheet" href="./addMeal.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <?php
        $_SESSION["mealsList"] = "../../MealsList/mealsList.php";
        $_SESSION["ordersList"] = "../../orderList/orderList.php";
        $_SESSION["reservationsList"] = "../../reservationList/reservationList.php";
        $_SESSION["managementMeals"] = $_SERVER["PHP_SELF"];
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
            $_SESSION["header_path"] = "../../header/header.css";
            include_once "../../header/header.php";
            include "../../../../connection.php";
        ?>
    
        
        <div class="container">
            <form method="POST" action="" class="p-5" enctype="multipart/form-data">
                <!-- <div class="form-group">
                    <label class="form-label">Identification</label>
                    <input name="id" class="form-control" required />
                </div> -->
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input name="name" class="form-control" required />
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea required name="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Image</label>
                    <input name="path_image" class="custom-file-input form-control" type="file" name="image" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Price</label>
                    <input name="price" type="number" class="form-control" required />
                </div>
                <div class="form-group">
                    <!-- <label class="form-label">Price</label>
                    <input name="price" type="number" class="form-control" /> -->
                    <label class="form-label" for="">Categories</label>
                    <select class="form-control" name="category" id="">
                        <option value="Main Course">Main Course</option>
                        <option value="Dessert">Dessert</option>
                        <option value="Appetizer">Appetizer</option>
                        <option value="Drinks">Drinks</option>
                    </select>
                </div>
                <div class="mt-2">
                    <button name="confirm" type="submit" class="me-1 btn btn-success">Confirm</button>
                    <button type="button" onclick="onReset()" class="me-1 btn btn-warning">Reset</button>
                    <button type="button" onclick="sweetAlert('warning')" class="me-1 btn btn-danger">Cancel</button>
                </div>
            </form>
    
            <script>
                function onReset() {
                    sweetAlert('warning');
                }
    
                function onCancel() {
                    sweetAlert('warning');
                }
            </script>
    
            <?php 
                include "../../../../connection.php";

                if(isset($_POST["confirm"])) {                    
                    // $id = $_POST["id"];
                    $name = $_POST['name'];
                    $description = $_POST['description'];
                    $path_image = $_FILES['path_image']['name'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];
                    
                    
                    try{
                        $query = "INSERT INTO menu VALUES (:id, :name, :description, :price, :category, :path_image)";
                        
                        $stmt = $pdo->prepare($query);
                        
                        // $stmt->bindParam(":id", $id);
                        $stmt->bindParam(":name", $name);
                        $stmt->bindParam(":description", $description);
                        $stmt->bindParam(":price", $price);
                        $stmt->bindParam(":category", $category);
                        $stmt->bindParam(":path_image", $path_image);
                        
                        $stmt->execute();
                        echo "
                            <script>
                                Swal.fire({
                                    title: 'Confirmation',
                                    text: 'The operation is completed',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok',
                                    cancelButtonText: 'Cancel'
                                }).then((result) => {
                                    // Perform an action based on the user's choice
                                    if (result.isConfirmed) {
                                        // Code to execute if confirmed
                                        console.log('Confirmed');
                                    } else {
                                        // Code to execute if cancelled
                                        console.log('Cancelled');
                                    }
                                });
                            </script>
                        ";

                    } catch(PDOException $e) {
                        echo $e->getMessage();

                        echo "
                            <script>
                                Swal.fire({
                                    title: 'Confirmation',
                                    text: ". json_encode($e->getMessage()) .",
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Ok',
                                    cancelButtonText: 'Cancel'
                                }).then((result) => {
                                    // Perform an action based on the user's choice
                                    if (result.isConfirmed) {
                                        // Code to execute if confirmed
                                        console.log('Confirmed');
                                    } else {
                                        // Code to execute if cancelled
                                        console.log('Cancelled');
                                    }
                                });
                            </script>
                        ";
                    }               
                }
            ?>
        </div>
    </body>
</html>

