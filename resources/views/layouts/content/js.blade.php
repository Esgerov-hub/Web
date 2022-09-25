<script>
    $("#submitbtn").click(function (event) {
        event.preventDefault();
        var data = $("#submitdataform").serialize();
        $.ajax({
            type: "post",
            url: "/contact/data",
            data: data,
            contentType: 'application/x-www-form-urlencoded',
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                if( data ) {
                    var msg = '<div class="alert alert-success" role="alert">'+
                        '<div class="alert-body" >'+'Mesajınız uğurla göndərildi!'+'</div>'+
                        '</div>';

                    $('#submitdataform-response').html(msg);
                }
                else {
                    var msg = '<div class="alert alert-danger" role="alert">'+
                        '<div class="alert-body" >'+'Mesajınız uğurla göndərildi!'+'</div>'+
                        '</div>';
                    $('#submitdataform-response').html(msg);
                }
                document.getElementById("submitdataform").reset();

            },
            error: function (data) {
                // Android.passParams(url);
            }
        });
    })

</script>
