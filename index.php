<?php

session_start(); // Hàm session_start() được sử dụng để bắt đầu một session.
// Dòng lệnh session_start() sẽ đăng ký phiên làm việc của người dùng trên Server, từ đó Server sẽ tạo ra một ID riêng không trùng lặp để nhận diện cho client hiện tại
$host = 'localhost';
$username = 'root';
$password = 'root';
$database_name = 'Mini_project_php';

//connection to server & database
$conn = mysqli_connect($host, $username, $password, $database_name) or die('Unable to connect');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            text-align: center;
        }

        .field {
            margin-bottom: 20px;
        }
    </style>

</head>

<body>

    <h2>Please Login</h2>
    <div>
        <form action="index.php" method="post">
            <input type="text" class="field" name="Username" placeholder="Username" required=""><br />
            <input type="password" class="field" name="Pass" placeholder="Password" required=""><br />
            <input type="checkbox" name="remember" <?php if (isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
            <label for="remember-me">Remember me</label>
            <br />
            <input type="submit" class="field" name="login" value="Login">


        </form>
    </div>
    <?php
    include 'Apps/libraries.php';

    $a = new Apps_Libs_DbConnection;
    ?>

    <?php
    if (isset($_POST['login'])) {
        if (!empty($_POST["Username"]) && !empty($_POST["Pass"])) {
            $Username = $_POST['Username'];
            $Pass = $_POST['Pass'];
            $select = mysqli_query($conn, " SELECT * FROM tb_student WHERE Username = '$Username' AND Pass = '$Pass' ");
            $row = mysqli_fetch_array($select);
            if ($row) {
                if (!empty($_POST["remember"])) {
                    setcookie("member_login", $Username, time() + (10 * 365 * 24 * 60 * 60));
                    setcookie("member_password", $Pass, time() + (10 * 365 * 24 * 60 * 60));
                    $_SESSION["Username"] = $Username;
                } else {
                    if (isset($_COOKIE["member_login"])) {
                        setcookie("member_login", "");
                    }
                    if (isset($_COOKIE["member_password"])) {
                        setcookie("member_password", "");
                    }
                }
                header("Location:Views/home.php");
            } else {
                $message = "Invalid Login";
            }
        } else {
            $message = "Both are Required Fields";
        }
        // $Username = $_POST['Username'];
        // $Pass = $_POST['Pass'];

        // $select = mysqli_query($conn, " SELECT * FROM tb_student WHERE Username = '$Username' AND Pass = '$Pass' ");
        // $row = mysqli_fetch_array($select);

        // if (is_array($row)) {
        //     $_SESSION["Username"] = $row['Username'];
        //     $_SESSION["Pass"] = $row['Pass'];
        // } else {
        //     echo '<script type = "text/javascript">';
        //     echo 'alert("Invalid Username or Password!");';
        //     echo 'window.location.href = "index.php" ';
        //     echo '</script>';
        // }
    }
    // if (isset($_SESSION["Username"])) {
    //     header("Location:Views/home.php");
    // }
    ?>


</body>

</html>