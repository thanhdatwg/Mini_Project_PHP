<?php
include "../libraries.php";
$modelProducts = new Models_Products();
if (isset($_POST['name'])) {
    $code = $_POST['code'];
    $allProducts = $modelProducts->buildQueryParams([
        "select" => "*",
        "where" => "",
    ])->selectAll();
    $checkCode = 0;
    foreach ($allProducts as $key => $product) {
        if ($product["code"] == $code){
            $checkCode = 1;
        }
    }
    if ($checkCode == 0){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $insertProduct = $modelProducts->buildQueryParams([
            "field" => "(name,price,quantity,code) values (?,?,?,?)",
            "values" => [$name, $price, $quantity, $code],
        ])->insert();
        echo 1;
    } else {
        echo 0;
    }
}