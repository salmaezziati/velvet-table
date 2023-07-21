<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo $_SESSION["header_path"] ?>">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?php echo $_SESSION["ordersList"] ?>">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SESSION["reservationsList"] ?>">Reservations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SESSION["mealsList"] ?>">Meals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SESSION["addMeal"] ?>">Add Meal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SESSION["modifyMeal"] ?>">Modify Meal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SESSION["removeMeal"] ?>">Remove Meal</a>
            </li>
        </ul>
        </div>
    </div>
    <p class="pt-3 me-5">
            Welcome <b>Mr Mezrioui</b>
    </p>
    </nav>
</body>
</html>