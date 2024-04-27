const site_url = "http://127.0.0.1:8000/";

$("body").on("keyup", "#search", function () {
    let text = $("#search").val();
    console.log(text);

    if (text.length > 0) {
        $.ajax({
            data: { search: text },
            //url: site_url + "search-product",
            url : '/search-product',
            method: 'post',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (result) {
                $("#searchProducts").html(result);
            },
            error: function (xhr, status, error) {
                // Handle error
            }
        }); //End Ajax
    } else {
        $("#searchProducts").html("");
    }
});



$("body").on("keyup", "#mobilesearch", function () {
    let text = $("#mobilesearch").val();
    console.log(text);

    if (text.length > 0) {
        $.ajax({
            data: { search: text },
            //url: site_url + "search-product",
            url : '/search-product',
            method: 'post',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (result) {
                $("#mobilesearchProducts").html(result);
            },
            error: function (xhr, status, error) {
                // Handle error
            }
        }); //End Ajax
    } else {
        $("#mobilesearchProducts").html("");
    }
});

