$(document).ready(function() {
    //check admin password is correct or not
    $('#current_pwd').keyup(function() {
        var current_pwd = $('#current_pwd').val();
        // alert(current_pwd);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/check-current-password',
            data: { current_pwd: current_pwd },
            success: function(resp) {
                if (resp == "false") {
                    $('#verifyCurrentPwd').html("Current password is incorrect");
                } else if (resp == "true") {
                    $("#verifyCurrentPwd").html("Current password is Correct");
                }
            },
            error: function() {
                alert("Error");
            }
        })
    });

});

// Computer\HKEY_CURRENT_USER\SOFTWARE\Microsoft\Windows\CurrentVersion\Policies\Explorer\DisallowRun