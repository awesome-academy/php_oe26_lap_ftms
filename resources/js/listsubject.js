function readSubject(id) {
    var idJquery = "#" + id;
    $.ajax({
        method: 'GET',
        dataType: 'html',
        url: '/subjects/' + id + '/show',
        success: function (response) {
            $("#content").html(response);
            $('#list li').removeClass('active');
            $(id).addClass('active');
        },
        error: function (e) {
            alert(e.message);
        }
    });
}
