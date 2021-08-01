<?php
include "../libraries.php";
$modelProducts = new Models_Products();
if (isset($_POST['id'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $id = $_POST['id'];
    $data = [$id,$name,$price,$quantity];

    $up = $modelProducts->buildQueryParams([
        "where" => "id = ".$id,
        "values" => [$name, $price, $quantity],
    ])->updateProduct($data);
    
    echo $name;
}