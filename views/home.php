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
        <div class="form-popup" id="add-form">
            <form class="form-container" method="post" id="add_product">
                <h1>New Product</h1>
                <br>
                <label for="name" style="display:flex"><b>Product name</b></label>
                <input type="text" placeholder="Enter name ..." name="name" id="name" required>

                <label for="price" style="display:flex"><b>Price</b></label>
                <input type="number" placeholder="Enter price ..." name="price" id="price" required>

                <label for="quantity" style="display:flex"><b>Quantity</b></label>
                <input type="number" placeholder="Enter quantity" name="quantity" id="quantity" required>

                <button type="submit" class="btn btn-primary" id="add_button">Submit</button>
                <button type="button" class="btn cancel" onclick="show_hide()">Cancel</button>
            </form>
        </div>
    </div>
    <div class="title_table">
        <h3>Data Table</h3>
        <button class="btn btn-primary" onclick="show_hide()">Add Product</button>
    </div>
    <div id="load_data_ajax">
    </div>
    <script src="../Apps/JS/showHideElement.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // fetch data by ajax
            function fetch_data() {
                $.ajax({
                    url: "../Apps/Libs/ajax.php",
                    method: "POST",
                    success: function(data) {
                        $('#load_data_ajax').html(data);
                    },
                });
            }
            fetch_data();
            //delete data
            $(document).on('click', '.del_data', function() {
                var id = $(this).data('id_del');
                $.ajax({
                    url: "../Apps/Libs/ajax.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        alert('Delete product successfully');
                        fetch_data();
                    },
                });
            });

            // update product
            $(document).on('click', '.save_data', function() {

                var currentRow = $(this).closest("tr");
                var id = parseInt(currentRow.find("td:eq(0)").text());
                var name = currentRow.find("td:eq(1)").text();
                var price = parseInt(currentRow.find("td:eq(2)").text());
                var quantity = parseInt(currentRow.find("td:eq(3)").text());

                $.ajax({
                    url: "../Apps/Libs/update.php",
                    method: "POST",
                    data: {
                        id: id,
                        name: name,
                        price: price,
                        quantity: quantity,
                    },
                    success: function(data) {
                        alert('Product information update successfully!!');
                        fetch_data();
                    },
                });
            });
            // insert data
            $('#add_button').on('click', function(event) {
                // event.preventDefault();
                var name = $('#name').val();
                var price = $('#price').val();
                var quantity = $('#quantity').val();
                let hasError = false
                if (name == '' || price == '' || quantity == '') {
                    hasError = true
                }
                if (!hasError) {
                    $.ajax({
                        url: "../Apps/Libs/ajax.php",
                        method: "POST",
                        data: {
                            name: name,
                            price: price,
                            quantity: quantity
                        },
                        success: function(data) {
                            alert('Product added successfully!!');
                            $('#add_product')[0].reset();
                            fetch_data();
                        },
                    });
                }

            });
            $(document).on('click', '.update_data', function() {
                var id = $(this).data('id_del');
                $("#code_" + id).attr("contenteditable", true);
                $("#name_" + id).attr("contenteditable", true);
                $("#price_" + id).attr("contenteditable", true);
                $("#quantity_" + id).attr("contenteditable", true);
                $("#code_" + id).css("background-color", "#cbcede");
                $("#name_" + id).css("background-color", "#cbcede");
                $("#price_" + id).css("background-color", "#cbcede");
                $("#quantity_" + id).css("background-color", "#cbcede");
                $("#action_" + id).css("background-color", "#cbcede");
                $("#update_" + id).css({
                    "display": "none"
                });
                $("#delete_" + id).css({
                    "display": "none"
                });
                $("#save_" + id).css({
                    "display": "block"
                });
                $("#cancel_" + id).css({
                    "display": "block"
                });

            })
            $(document).on('click', '.cancel_data', function() {
                var id = $(this).data('id_del');
                $("#code_" + id).attr("contenteditable", false);
                $("#name_" + id).attr("contenteditable", false);
                $("#price_" + id).attr("contenteditable", false);
                $("#quantity_" + id).attr("contenteditable", false);
                $("#code_" + id).css("background-color", "");
                $("#name_" + id).css("background-color", "");
                $("#price_" + id).css("background-color", "");
                $("#quantity_" + id).css("background-color", "");
                $("#action_" + id).css("background-color", "");
                $("#update_" + id).css({
                    "display": "block"
                });
                $("#delete_" + id).css({
                    "display": "block"
                });
                $("#save_" + id).css({
                    "display": "none"
                });
                $("#cancel_" + id).css({
                    "display": "none"
                });

            })
        });
    </script>
</body>

</html>