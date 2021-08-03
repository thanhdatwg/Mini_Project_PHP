function fetch_data() {
    $.ajax({
        url: "../Apps/Controller/ajax.php",
        method: "POST",
        success: function(data) {
            $('#load_data_ajax').html(data);
        },
    })
}

