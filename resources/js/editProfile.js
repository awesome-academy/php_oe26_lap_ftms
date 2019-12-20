$(document).ready(function () {
    $("#avatar").on('change', function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#imageAvatar").attr("src", e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    $("#formEdit").submit(function (e) {
        e.preventDefault();
        var url = '/users/' + $("#formEdit").attr('name') + '/update';
        var avatar = $("#avatar").val();
        avatar = avatar.replace('C:\\fakepath', '/images/avatar/');
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                name: $("#name").val(),
                phone: $("#phone").val(),
                address: $("#address").val(),
                avatar: avatar,
            },
            success: function (response) {
                alert('Success!');
            },
            error: function (data) {
                var errors = $.parseJSON(data.responseText);
                $('#edit-task-errors').html('');
                $('#edit-error-bag').addClass("alert alert-danger");
                $.each(errors.errors, function (key, value) {
                    $('#edit-task-errors').append('<li>' + value + '</li>');
                });
                $("#edit-error-bag").show();
            }
        });
    });
});
