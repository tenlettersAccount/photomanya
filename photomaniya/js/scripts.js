$(function () {
    var btn = $("#button_make_order");
    btn.click(function () {
        $('.modal').fadeIn(500);
        $(".modal-content2").fadeIn(500);
    });
    $('.modal').click(function (e) {
        $(this).fadeOut(500);
    });
    $(".modal-content2").click(function (e) {
        e.stopImmediatePropagation();
    });
    $('#sendData').click(function (e) {
        $(".modal-content2 form .form-input").css('border-color', '#D3D3D3');
        e.preventDefault();
        $.ajax({
            type: 'post'
            , url: './contact-form-handler.php'
            , dataType: 'text'
            , data: {
                name: $('#user_name').val()
                , email: $('#user_email').val()
                , tel: $('#user_tel').val()
                , postId: $("#postId").attr("postId")
                , adminEmail: $("#postId").attr("adminEmail")
            }
            , success: function (e) {
                switch (e) {
                case "bad_email":
                    $(".modal-content2 form #user_email").css('border-color', 'red');
                    $(".modal-content2 form #err").slideDown(500);
                    $(".modal-content2 form i").slideDown(500);
                    break;
                case "no_num":
                    $(".modal-content2 form #user_tel").css('border-color', 'red');
                    $(".modal-content2 form #err").slideDown(500);
                    $(".modal-content2 form i").slideDown(500);
                    break;
                case "no_email":
                    $(".modal-content2 form #user_email").css('border-color', 'red');
                    $(".modal-content2 form #err").slideDown(500);
                    $(".modal-content2 form i").slideDown(500);
                    break;
                case "no_name":
                    $(".modal-content2 form #user_name").css('border-color', 'red');
                    $(".modal-content2 form #err").slideDown(500);
                    $(".modal-content2 form i").slideDown(500);
                    break;
                case "ok":
                    $(".modal-content2 form #err").slideUp(500);
                    $(".modal-content2 form i").slideUp(500);
                    $(".modal-content2 form #ok").slideDown(500);
                    setTimeout(function () {
                        $('.modal').fadeOut(500);
                        $(".modal-content2").fadeOut(500);
                        $(".modal-content2 form #ok").fadeOut(500);
                        $('#user_email').val("");
                        $('#user_name').val("");
                        $('#user_tel').val("");
                    }, 2500);
                    break;
                }
            }
        });
    });
});