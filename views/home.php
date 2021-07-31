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
        body {
            text-align: center;
        }
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
<style>

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: relative;
  right: 15px;
  border: 3px solid #f1f1f1;
  margin-top: 40px;
}

/* Add styles to the form container */
.form-container {
  position: static;
  max-width: 700px;
  padding: 20px;
  background-color: white;
  margin-left: 25%;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=number] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>

<body>

    <h2>Welcome <?php echo $_SESSION['Username']; ?></h2>
    Click here to <a href="logout.php">Logout</a>
    <br />
    <p></p>
    <div>
        <input type="search" placeholder="Enter a name to searching"/>
        <button class="btn" onclick="show_hide()">Add Product</button>
        <div class="form-popup" id="add-form">
            <form class="form-container" method="post">
                <h1>Thêm mới sản phẩm</h1>

                <label for="name"><b>Tên sản phẩm</b></label>
                <input type="text" placeholder="Nhập tên" name="name" id="name" required>

                <label for="price"><b>Giá sản phẩm</b></label>
                <input type="number" placeholder="Nhập giá" name="price" id="price" required>

                <label for="quantity"><b>Số lượng</b></label>
                <input type="number" placeholder="Nhập số lượng" name="quantity" id="quantity" required>

                <button type="submit" class="btn" id="add_button">Thêm mới</button>
                <button type="button" class="btn cancel" onclick="show_hide()" >Đóng</button>
            </form>
        </div>
    </div>
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
            <?php
            // var_dump($allProducts);
            foreach ($allProducts as $row => $product) {
                echo '
                    <tr>
                        <td>'. $product["id"].'</td>
                        <td>'. $product["name"] .'</td>
                        <td>'. $product["price"].'</td>
                        <td>'. $product["quantity"] .'</td>
                        <td><button class="btn btn-update">Update</button>
                        <button class="btn btn-delete">Delete</button></td>
                    </tr>
                ';
            }
            ?>
        </tbody>
    </table>
    <script src="../Apps/JS/showHideElement.js"></script>
    <script type="text/javascript">
        $('#add_button').on('click',function (){
            var name = $('#name').val();
            var price = $('#price').val();
            var quantity = $('#quantity').val();

            if (name== '' || price=='' || quantity ==''){
                alert('khong duoc bo trong cac tuong');
            } else {
                $.ajax({
                    url: "../Apps/Libs/ajax.php",
                    method: "POST",
                    data: {name:name, price:price, quantity:quantity},
                    success : function (data) {
                        alert('truyen thanh cong');
                    },
                });
            }
        });
    </script>
</body>

</html>