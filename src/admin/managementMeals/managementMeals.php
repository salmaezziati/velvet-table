<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./managementMeals.css">
    <title>Document</title>
    
</head>
<body onload="updateActivePage()">
        
    <?php
        $_SESSION["activeSection"] = "add";
        $_SESSION["activePage"] = "managementMeals";
    ?>

<?php
        $_SESSION["header_path"] = "../header/header.css";
        include_once "../header/header.php";
        include "../../../connection.php";
        ?>


    <div class="operations mt-2">
        <div class="d-flex gap-2">
            <a id="addLink" onclick="updateActivePage('add')" href="#">Add</a>
            <a id="modifyLink" onclick="updateActivePage('modify')" href="#">Modify</a>
            <a id="deleteLink" onclick="updateActivePage('delete')" href="#">Delete</a>
        </div>
        <hr class="p-0 m-1">
    </div>

    <div style="display: block" id="addMeal">
        <?php 
            $_SESSION["addMealCss"] = "./addMeal/addMeal.css";
            $_SESSION["activeSection"]="add";
            include_once "./addMeal/addMeal.php";
            ?>
    </div>
    <div style="display: none" id="modifyMeal">
        <?php 
            $_SESSION["modifyMealCss"] = "./modifyMeal/modifyMeal.css";
            $_SESSION["activeSection"]="modify";
            include_once "./modifyMeal/modifyMeal.php";
            ?>
    </div>
    <div style="display: none" id="removeMeal">
        <?php 
            $_SESSION["deleteMealCss"] = "./removeMeal/removeMeal.css";
            $_SESSION["activeSection"]="delete";
            include_once "./removeMeal/removeMeal.php";
        ?>
    </div>

    <script>
        function updateActivePage(para="") {
            const addMeal = document.getElementById("addMeal");
            const modifyMeal = document.getElementById("modifyMeal");
            const removeMeal = document.getElementById("removeMeal");

            const addLink = document.getElementById("addLink");
            const modifyLink = document.getElementById("modifyLink");
            const removeLink = document.getElementById("deleteLink");

            if(para !== "") {
                document.cookie = `activeLink=${para}; expires=Thu, 01 Jan 2024 00:00:00 UTC; path=/;`;
            }

            if(getCookie("activeLink") == "add") {
                addMeal.style.display = "block";
                modifyMeal.style.display = "none";
                removeMeal.style.display = "none";

                addLink.classList.add("activeLink");
                modifyLink.classList.remove("activeLink");
                deleteLink.classList.remove("activeLink");
            } else if(getCookie("activeLink") == "modify") {
                addMeal.style.display = "none";
                modifyMeal.style.display = "block";
                removeMeal.style.display = "none";    

                addLink.classList.remove("activeLink");
                modifyLink.classList.add("activeLink");
                deleteLink.classList.remove("activeLink");
            } else if(getCookie("activeLink") == "delete") {
                addMeal.style.display = "none";
                modifyMeal.style.display = "none";
                removeMeal.style.display = "block";

                addLink.classList.remove("activeLink");
                modifyLink.classList.remove("activeLink");
                deleteLink.classList.add("activeLink");
            }
        }

        function getCookie(name) {
            var cookies = document.cookie.split("; ");
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i].split("=");
                if (cookie[0] === name) {
                return cookie[1];
                }
            }
            return null;
        }

        // window.onload = updateActivePage();
    </script>

</body>
</html>