<?php
include "../libraries.php";
$modelProducts = new Models_Products();
if (isset($_POST['name'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $insertProduct = $modelProducts->buildQueryParams([
        "field" => "(name,price,quantity,code) values (?,?,?,?)",
        "values" => [$name, $price, $quantity,$code],
    ])->insert();
}

//delete data
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $delProduct = $modelProducts->buildQueryParams([
        "where" => "id = " . $id,
    ])->delete();
}
// fetch data
$out_put = '';
$allProducts = $modelProducts->buildQueryParams([
    "select" => "*",
    "where" => "",
])->selectAll();
$out_put .= '
        <table class="customers">
            <thead>
                <tr>
                    <th>Product code</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th style="display:flex; justify-content: center">Action</th>
                </tr>
            </thead>
            <tbody>
    ';
if (!empty($allProducts)) {
    foreach ($allProducts as $product) {
        $out_put .= '
                <tr>
                    <td id=' . "code_" .  $product["id"] . '>' . $product["code"] . '</td>
                    <td id=' . "name_" .  $product["id"] . '>' . $product["name"] . '</td>
                    <td id=' . "price_" .  $product["id"] . '>' . $product["price"] . '</td>
                    <td id=' . "quantity_" .  $product["id"] . '>' . $product["quantity"] . '</td>
                    <td id=' . "action_" .  $product["id"] . ' style="display:flex; justify-content: space-evenly">
                    <button id=' . "update_" .  $product["id"] . ' class="btn btn-warning update_data" data-id_del=' . $product["id"] . '>Update</button>
                    <button id=' . "delete_" .  $product["id"] . ' class="btn btn-danger del_data" data-id_del=' . $product["id"] . '>Delete</button>
                    <button id=' . "save_" .  $product["id"] . ' class="btn btn-success save_data" data-id_update='.$product["id"].' style="display:none" >Save</button>
                    <button id=' . "cancel_" .  $product["id"] . ' class="btn btn-danger cancel_data" data-id_del=' . $product["id"] . ' style="display:none" >Cancel</button>
                    </td>
                </tr>
            ';
    }
} else {
    $out_put .= '
            <tr>
                <td colspan="5" style="text-align: center">No data</td>
            </tr>
        ';
}
$out_put .= '
        </tbody>
    </table>
    ';

echo $out_put;
