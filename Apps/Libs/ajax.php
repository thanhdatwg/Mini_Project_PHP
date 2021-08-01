<?php
include "../libraries.php";
$modelProducts = new Models_Products();
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    echo 1;

    $insertProduct = $modelProducts->buildQueryParams([
        "field" => "(name,price,quantity) values (?,?,?)",
        "values" => [$name, $price, $quantity],
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
                    <th>Quantity</th>
                    <th>Price</th>
                    <th style="display:flex; justify-content: center">Action</th>
                </tr>
            </thead>
            <tbody>
    ';
if (!empty($allProducts)) {
    foreach ($allProducts as $product) {
        $out_put .= '
                <tr>
                    <td id="code-product" contenteditable>' . $product["id"] . '</td>
                    <td contenteditable>' . $product["name"] . '</td>
                    <td contenteditable>' . $product["price"] . '</td>
                    <td contenteditable>' . $product["quantity"] . '</td>
                    <td style="display:flex; justify-content: space-evenly"><button id="update_product" class="btn btn-warning">Update</button>
                    <button style="display:none" id="save_value" class="btn btn-success">Save</button>
                    <button style="display:none" id="cancel" class="btn btn-danger">Cancel</button>
                    <button id="delete_product" class="btn btn-danger del_data" data-id_del=' . $product["id"] . '>Delete</button></td>
                </tr>
            ';
    }
} else {
    $out_put .= '
            <tr>
                <td colspan="5" style="text-align: center"> Danh sách đang trống</td>
            </tr>
        ';
}
$out_put .= '
        </tbody>
    </table>
    ';

echo $out_put;
