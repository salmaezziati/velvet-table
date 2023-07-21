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
            $_SESSION["mealsList"] = "../MealsList/mealsList.php";
            $_SESSION["ordersList"] = "../orderList/orderList.php";
            $_SESSION["reservationsList"] = "./reservationList.php";
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

        $sql = "SELECT * from reservation";
        $result = $pdo->query($sql);

        if($result->rowCount() > 0) {
            echo "<div class='container mt-5'>";
                echo "<table id='reservationList' class='table table-secondary table-hover table-striped mt-5'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Id_reservation</th>";
                            echo "<th>Email</th>";
                            echo "<th>Phone</th>";
                            echo "<th>Date of reservation</th>";
                            echo "<th>hour</th>";
                            echo "<th>First name</th>";
                            echo "<th>Last name</th>";
                            echo "<th>Tail of Group</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row=$result->fetch()) {
                                echo "<tr>";
                                    echo "<td>" . $row["id_reservation"] . "</td>";
                                    echo "<td>" . $row["email"] . "</td>";
                                    echo "<td>" . $row["phone"] . "</td>";
                                    echo "<td>" . $row["dateRev"] . "</td>";
                                    echo "<td>" . $row["hour"] . "</td>";
                                    echo "<td>" . $row["fname"] . "</td>";
                                    echo "<td>" . $row["lname"] . "</td>";
                                    echo "<td>" . $row["tailOfGroup"] . "</td>";
                                echo "</tr>";
                            }
                    echo "</tbody>";
                echo "</table>";
            echo "</div>";
        }
    ?>

    <!-- <div class="container mt-5">
        <table id="reservationList" class="table table-secondary table-hover table-striped mt-5">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Group size</th>
                    <th>Date</th>
                    <th>Hour</th>
                    <th>Completed</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mezrioui Hakim</td>
                    <td>Mezrioui.Hakim@gmail.com</td>
                    <td>Phone</td>
                    <td>Group size</td>
                    <td>Date</td>
                    <td>Hour</td>
                    <td>true</td>
                </tr>
                <tr>
                    <td>Mezrioui Hakim</td>
                    <td>Mezrioui.Hakim@gmail.com</td>
                    <td>Phone</td>
                    <td>Group size</td>
                    <td>Date</td>
                    <td>Hour</td>
                    <td>false</td>
                </tr>
                <tr>
                    <td>Mezrioui Hakim</td>
                    <td>Mezrioui.Hakim@gmail.com</td>
                    <td>Phone</td>
                    <td>Group size</td>
                    <td>Date</td>
                    <td>Hour</td>
                    <td>false</td>
                </tr>
                <tr>
                    <td>Mezrioui Hakim</td>
                    <td>Mezrioui.Hakim@gmail.com</td>
                    <td>Phone</td>
                    <td>Group size</td>
                    <td>Date</td>
                    <td>Hour</td>
                    <td>false</td>
                </tr>
            </tbody>
        </table>
    </div> -->
    
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
