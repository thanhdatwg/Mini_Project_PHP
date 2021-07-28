<?php
session_start();
include '../Apps/libraries.php';

$a = new Models_Products();
$result = $a->buildQueryParams([
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
    body{
        text-align: center;
    }
    </style>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

    <h2>Welcome <?php echo $_SESSION['Username']; ?></h2>
    Click here to <a href = "logout.php">Logout</a>
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
        <tr>
            <td>Alfreds Futterkiste</td>
            <td>Maria Anders</td>
            <td>Germany</td>
            <td>1000đ</td>
        </tr>
        <tr>
            <td>Berglunds snabbköp</td>
            <td>Christina Berglund</td>
            <td>Sweden</td>
            <td>1000đ</td>
        </tr>
        <tr>
            <td>Centro comercial Moctezuma</td>
            <td>Francisco Chang</td>
            <td>Mexico</td>
        </tr>
        <tr>
            <td>Ernst Handel</td>
            <td>Roland Mendel</td>
            <td>Austria</td>
        </tr>
        <tr>
            <td>Island Trading</td>
            <td>Helen Bennett</td>
            <td>UK</td>
        </tr>
        <tr>
            <td>Königlich Essen</td>
            <td>Philip Cramer</td>
            <td>Germany</td>
        </tr>
        <tr>
            <td>Laughing Bacchus Winecellars</td>
            <td>Yoshi Tannamuri</td>
            <td>Canada</td>
        </tr>
        <tr>
            <td>Magazzini Alimentari Riuniti</td>
            <td>Giovanni Rovelli</td>
            <td>Italy</td>
        </tr>
        <tr>
            <td>North/South</td>
            <td>Simon Crowther</td>
            <td>UK</td>
        </tr>
        <tr>
            <td>Paris spécialités</td>
            <td>Marie Bertrand</td>
            <td>France</td>
        </tr>
        </tbody>
    </table>
</body>
</html>
