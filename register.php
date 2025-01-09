<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            include '../database/dbconnect.php';
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            if ($password == $confirm_password){
                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
                $result = mysqli_query($conn ,$sql);
            }
            if ($result) {
                // Redirect to the login page on success
                header("Location: ../pages/login.html");
                exit();
            }
        }

?>
