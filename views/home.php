<?php
session_start();
include '../Apps/libraries.php';

$modelProducts = new Models_Products();
$allProducts = $modelProducts->buildQueryParams([
    "select" => "*",
    "where" => "",
])->selectAll();
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
    </style>
    <link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

    <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
    <div align="center">
        <?php if (empty($_SESSION["username"])) {

            header('location:index.php')

        ?>



        <?php } else { ?>

            <div class="member-dashboard">You have Successfully logged in!. <a href="logout.php" style="color: #fff">Logout</a></div>

        <?php } ?>

    </div>
    Click here to <a href="logout.php">Logout</a>
    <br />
    <p></p>
    <table class="customers">
        <thead>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            var_dump($allProducts);
            foreach ($allProducts as $row => $product) {
                echo "<tr>";
                echo "<td>" . $product["id"] . "</td>";
                echo "<td>" . $product["name"] . "</td>";
                echo "<td>" . $product["price"] . "</td>";
                echo "<td>" . $product["quantity"] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>