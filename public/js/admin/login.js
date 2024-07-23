$(document).ready(function () {


    $("#login-form").on("submit", function (e) {
        e.preventDefault();
        $(".validation").html("")
        $.ajax({
            type: "post",
            url: "/admin/auth",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "email" : $("#email").val(),
                "password" : $("#password").val(),
            },
            success: function (response) {
                location.href = "/admin/products"
            },
            error: function (xhr, status, error) {
                if(xhr.status == 422){
                    var errors = xhr.responseJSON.errors;

                    if (errors.hasOwnProperty('email')) {
                        $('#email-error').text(errors.email[0]);
                    }
                    if (errors.hasOwnProperty('password')) {
                        $('#password-error').text(errors.password[0]);
                    }
                }

                if(xhr.status == 401){
                    $('#message-error').text(xhr.responseJSON.message);
                }
            }
        });
     })
});
