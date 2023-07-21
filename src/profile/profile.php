<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./profile.css">    
    <script src="../../jquery/jquery.min.js"></script>
    <style>
        button.editYourAccount:hover {
            color: white;
        }
    </style>
</head>
<body class="container">
    <?php 
        include "../../connection.php";
        
        if($_COOKIE["user"]) {
            include "../helpers/getUser.php";
            $email = $_COOKIE['user'];
            try {
                $query = "SELECT * FROM member WHERE email = :email";
                
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":email", $email);

                $stmt->execute();
                $user = $stmt->fetch();

                $GLOBALS["email"] = $user["email"];
                $GLOBALS["name"] = $user["name"];
                
                $query = "SELECT count(*) FROM reservation where id_member = :id_member";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id_member", $GLOBALS["id_member"]);
                $stmt->execute();

                $numberOfReservation = $stmt->fetchColumn();

                $query = "SELECT count(*) FROM orders where id_member = :id_member";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id_member", $GLOBALS["id_member"]);
                $stmt->execute();

                $numberOfOrders = $stmt->fetchColumn();

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            
            if(isset($_POST["logout"]) and isset($_COOKIE["user"])) {
                setcookie('user', '', time() - 3600, '/');
                
                echo "
                    <script>
                        Swal.fire({
                            title: 'This account already exist',
                            text: 'You should just sign in',
                            icon: 'info',
                            showCancelButton: false,
                            confirmButtonText: 'Ok',
                            cancelButtonText: 'Not now'
                        }).then((result) => {
                            // Perform an action based on the user's choice
                            if (result.isConfirmed) {
                                // Code to execute if confirmed
                                window.location.href = '../logIn&signUp/login&signup.php';
                            } else {
                                // Code to execute if cancelled
                            }
                        });
                    </script>
                ";

                header("http://localhost/hakim&salma/Hakim&Salma/src/home/");
            }

            if(isset($_POST["edit"]) and isset($_COOKIE["user"])) {
                $name = $_POST["name"];
                $email = $_POST["email"];
                $oldPassword = $_POST["oldPassword"];
                $newPassword = $_POST["newPassword"];

                try {
                    $query = "UPDATE member SET name = :name, email = :email, password = :newPassword WHERE id_member = :id_member and password = :oldPassword";
                    $stmt = $pdo->prepare($query);
    
                    $stmt->bindParam(":name", $name);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":newPassword", $newPassword);
                    $stmt->bindParam(":oldPassword", $oldPassword);
                    $stmt->bindParam(":id_member", $GLOBALS["id_member"]);
    
                    $stmt->execute();

                    $GLOBALS["email"] = $_POST["email"];
                    $GLOBALS["name"] = $_POST["name"];

                    $cookieName = "user";
                    $cookieValue = $_POST["email"];
                    $expiration = time() + (86400 * 30);

                    setcookie($cookieName, $cookieValue, $expiration, "/");

                    header("http://localhost/hakim&salma/Hakim&Salma/src/home/");
                } catch(PDOException $e) {
                    $e->getMessage();
                }
            }
        }
    ?>

    <div class="">
        <div class="container profile">
            <div class="cover-photo">
            </div>
            <div class="profile-name"><?php echo $GLOBALS["name"] ?></div>
    
                <p  class="email"><?php echo $GLOBALS["email"] ?></p>
                <span class="d-flex justify-content-between my-3">
                    <p class="m-0">Your reservations</p> <span class="badge bg-info"><b><?php echo $numberOfReservation ?></b></span>
                </span>
                <span class="d-flex justify-content-between my-3">
                    <p class="m-0">Your Orders</p><span class="badge bg-info"><b><?php echo $numberOfOrders ?></b></span>
                </span>
                <form id="goToEdit" method="post">
                    <button type="button" id="editProfile" name="editProfile" class="msg-btn">Edit your profile</button>
                    <button type="submit" name="logout" class="follow-btn">Logout</button>
                </form>
            <div>
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-youtube"></i>
                <i class="fab fa-twitter"></i>
            </div>
        </div> 

        <span>
        <div class="edit-box container" style="display: none;">
            <h2>Edit Profile</h2>
            <form method="POST" id="editForm">
                <div class="user-box">
                    <input type="text" name="name" required="" value="<?php echo $user["name"] ?>">
                    <label>Name</label>
                </div>
                <div class="user-box">
                    <input type="email" name="email" required="" value="<?php echo $user["email"] ?>">
                    <label>Email</label>
                </div>
                <div class="user-box">
                    <input type="password" name="oldPassword" required="">
                    <label>old Password</label>
                </div>
                <div class="user-box">
                    <input type="password" name="newPassword" required="">
                    <label>New Password</label>
                </div>
                <span class="d-flex gap-3 justify-content-center align-items-center">
                    <button id="edit" type="submit" name="edit" href="#">Edit</button>
                    <input class="btn btn-outline-danger" style="padding: .7em 1em;" id="cancel" type="button" name="Cancel" href="#" value="Cancel"/>
                </span>
            </form>
            </div>
        </span>

        <script src="./profile.js"></script>
</body>
</html>