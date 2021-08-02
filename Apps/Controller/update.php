<?php
include "../libraries.php";
$modelProducts = new Models_Products();
if (isset($_POST['code'])) {
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
        $id = $_POST['id'];
        $data = [$id,$name,$price,$quantity,$code];

        $up = $modelProducts->buildQueryParams([
            "where" => "id = ".$id,
            "values" => [$name, $price, $quantity, $code],
        ])->updateProduct($data);
        echo $success = 1;
    } else {
        echo $error = 0;
    }
}