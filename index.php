<?php

session_start();

//connection to server & database
$conn = mysqli_connect('localhost', 'root', 'root', 'Mini_project_php') or die('Unable to connect');

if (isset($_POST["login"])) {

    $username = $_POST['username'];

    $password = $_POST['password'];

    $sql = "Select * from tb_student where Username ='$username' and Pass ='$password'";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);

    if ($row) {

        $_SESSION["username"] = $row["Username"];


        if (!empty($_POST["remember"])) {

            setcookie("user_login", $_POST["username"], time() + (10 * 365 * 24 * 60 * 60));

            setcookie("userpassword", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
        } else {

            if (isset($_COOKIE["user_login"])) {

                setcookie("user_login", "");
            }

            if (isset($_COOKIE["userpassword"])) {

                setcookie("userpassword", "");
            }
        }

        header('location:Views/home.php');
    } else {

        $message = "Invalid Login";
    }
}

?>

<!DOCTYPE html>

<html>

<head>

    <title>Mini-Project-PHP</title>

    <style>
        #login {



            padding: 20px 60px;

            background: #25AAE1;

            color: #555;

            display: inline-block;

            border-radius: 4px;

        }

        .field-group {

            margin-top: 15px;

        }

        .input-field {

            padding: 8px;

            width: 200px;

            border: #A3C3E7 1px solid;

            border-radius: 4px;

        }

        .form-submit-button {

            background: #EC008C;

            border: 0;

            padding: 8px 20px;

            border-radius: 4px;

            color: #FFF;

            text-transform: uppercase;

        }

        .error-message {

            text-align: center;

            color: #FF0000;

        }
    </style>


    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <div align="center">



        <form action="" method="post" id="login">

            <div class="error-message"><?php if (isset($message)) {
                                            echo $message;
                                        } ?></div>

            <h4>Please login</h4>

            <div class="field-group">

                <div><label for="login">Username</label></div>

                <div>



                    <input name="username" type="text" value="<?php if (isset($_COOKIE["user_login"])) {
                                                                    echo $_COOKIE["user_login"];
                                                                } ?>" class="input-field">

                </div>

                <div class="field-group">

                    <div><label for="password">Password</label></div>

                    <div><input name="password" type="password" value="<?php if (isset($_COOKIE["userpassword"])) {
                                                                            echo $_COOKIE["userpassword"];
                                                                        } ?>" class="input-field">

                    </div>

                    <div class="field-group">

                        <div><input type="checkbox" name="remember" id="remember" <?php if (isset($_COOKIE["user_login"])) { ?> checked <?php } ?> />

                            <label for="remember-me">Remember me</label>

                        </div>

                        <div class="field-group">

                            <div><input type="submit" name="login" value="Login" class="form-submit-button"></span></div>

                        </div>

        </form>

    </div>

    <div>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- horizental ad -->
        <ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-8906663933481361" data-ad-slot="6662734336"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>


</body>

</html>