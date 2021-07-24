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
            <input type="submit" class="field" name="login" value="Login">
        </form>
    </div>


</body>

</html>