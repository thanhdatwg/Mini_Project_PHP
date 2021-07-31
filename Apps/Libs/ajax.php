<?php
    include "../libraries.php";
    $modelProducts = new Models_Products();
    // $allProducts = $modelProducts->buildQueryParams([
    //     "select" => "*",
    //     "where" => "",
    // ])->selectAll();
    // $insertProduct = $modelProducts->buildQueryParams([
    //     "field" => "(name,price,quantity) values (?,?,?)",
    //     "values" => ["thuoc ke",1234,12],
    // ])->insert();

    // var_dump($insertProduct);
    
    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        echo 1;

    $insertProduct = $modelProducts->buildQueryParams([
        "field" => "(name,price,quantity) values (?,?,?)",
        "values" => [$name,$price,$quantity],
    ])->insert();

    }
?>