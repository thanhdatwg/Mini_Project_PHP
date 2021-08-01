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
            <form class="form-container" method="post" id="add_product">
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
    <h3>Bảng thống kê kho hàng</h3>
    <div id="load_data_ajax">

    </div>
    <script src="../Apps/JS/showHideElement.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // fetch data by ajax
            function fetch_data () {
                $.ajax({
                    url: "../Apps/Libs/ajax.php",
                    method: "POST",
                    success : function (data) {
                        $('#load_data_ajax').html(data);
                        // fetch_data();
                    }, 
                });
            }
            fetch_data();

            //delete data
            $(document).on('click', '.del_data', function () {
                var id = $(this).data('id_del');
                $.ajax({
                    url: "../Apps/Libs/ajax.php",
                    method: "POST",
                    data: {id:id},
                    success : function (data) {
                        alert('Xoa thanh cong');
                        fetch_data();
                    }, 
                });
            });

            // insert data
            $('#add_button').on('click',function (event){
                // event.preventDefault();
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
                            alert('Thêm sản phẩm thành công!');
                            $('#add_product')[0].reset();
                        }, 
                    });
                }
            });
        });
        
    </script>
</body>

</html>