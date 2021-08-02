<?php
include "../libraries.php";
$modelProducts = new Models_Products();
if (isset($_POST['code'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $id = $_POST['id'];
    $data = [$id,$name,$price,$quantity,$code];

    $up = $modelProducts->buildQueryParams([
        "where" => "id = ".$id,
        "values" => [$name, $price, $quantity, $code],
    ])->updateProduct($data);
    
    echo $name;
}