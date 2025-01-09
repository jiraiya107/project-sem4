<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

            include '../database/dbconnect.php';
            $username = $_POST["email"];
            $password = $_POST["password"];
                $sql = "select * from users where username='$username' AND password='$password'";
                $result = mysqli_query($conn ,$sql);
                $num = mysqli_num_rows($result);
                if ($num == 1){
                    session_start();
                    $_SESSION['loggedin'] == true;
                    $_SESSION['username'] = $username;
                }
                if ($result) {
                    // Redirect to the login page on success
                    header("Location: ../pages/home.php");
                    exit();
                }
        }
?>
