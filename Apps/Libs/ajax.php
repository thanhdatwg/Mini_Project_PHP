<?php
    include "../libraries.php";
    $modelProducts = new Models_Products();
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

    //delete data
    if(isset($_POST['id'])){
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
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
    ';
    if (!empty($allProducts)){
        foreach($allProducts as $product){
            $out_put .= '
                <tr>
                    <td contenteditable>'. $product["id"].'</td>
                    <td contenteditable>'. $product["name"] .'</td>
                    <td>'. $product["price"].'</td>
                    <td>'. $product["quantity"] .'</td>
                    <td><button class="btn btn-update">Update</button>
                    <button class="btn btn-delete del_data" data-id_del='.$product["id"].'>Delete</button></td>
                </tr>
            ';
        }
    } else {
        $out_put.='
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
?>