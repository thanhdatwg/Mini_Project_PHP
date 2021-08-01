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

    </style>
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>

    <div class="header">
        <a href="#default" class="logo">Mini Project PHP</a>
        <div class="header-right">
            <a class="active" href="logout.php">Logout</a>
        </div>
    </div>
    <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
    <div>
        <input style="width: 150px;height: 33px;" type="search" placeholder="Enter a name to searching" />
        <button class="btn btn-primary" onclick="show_hide()">Add Product</button>
        <div class="form-popup" id="add-form">
            <form class="form-container" method="post">
                <h1>Thêm mới sản phẩm</h1>

                <label for="name"><b>Tên sản phẩm</b></label>
                <input type="text" placeholder="Nhập tên" name="name" id="name" required>

                <label for="price"><b>Giá sản phẩm</b></label>
                <input type="number" placeholder="Nhập giá" name="price" id="price" required>

                <label for="quantity"><b>Số lượng</b></label>
                <input type="number" placeholder="Nhập số lượng" name="quantity" id="quantity" required>

                <button type="submit" class="btn btn-primary" id="add_button">Submit</button>
                <button type="button" class="btn cancel" onclick="show_hide()">Cancel</button>
            </form>
        </div>
    </div>
    <table class="customers">
        <thead>
            <tr>
                <th>Product code</th>
                <th>Product's name</th>
                <th>Amount</th>
                <th>Price</th>
                <th style="display: flex; justify-content: center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // var_dump($allProducts);
            foreach ($allProducts as $row => $product) {
                echo '
                    <tr>
                        <td>' . $product["id"] . '</td>
                        <td>' . $product["name"] . '</td>
                        <td>' . $product["price"] . '</td>
                        <td>' . $product["quantity"] . '</td>
                        <td style="display: flex;justify-content: space-evenly"><button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">Delete</button></td>
                    </tr>
                ';
            }
            ?>
        </tbody>
    </table>
    <script src="../Apps/JS/showHideElement.js"></script>
    <script type="text/javascript">
        $('#add_button').on('click', function() {
            var name = $('#name').val();
            var price = $('#price').val();
            var quantity = $('#quantity').val();

            if (name == '' || price == '' || quantity == '') {
                alert('khong duoc bo trong cac tuong');
            } else {
                $.ajax({
                    url: "../Apps/Libs/ajax.php",
                    method: "POST",
                    data: {
                        name: name,
                        price: price,
                        quantity: quantity
                    },
                    success: function(data) {
                        alert('truyen thanh cong');
                    },
                });
            }
        });
    </script>
</body>

</html>