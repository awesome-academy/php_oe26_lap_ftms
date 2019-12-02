$(document).ready( function () {
    $("#list li").on('click', function () {
        var id = this.id;
        var course_id = this.value;
        $("#list li").removeClass('active');
        $("#" + id).addClass('active');
        if (id.replace('history', '') != course_id) {
            id = id.replace('subject', '');
            $.ajax({
                method: 'POST',
                dataType: 'html',
                url: '/subjects/' + id + '/show',
                data: {
                    course_id: course_id,
                },
                success: function (response) {
                    $("#content").html(response);
                },
                error: function (e) {
                    alert('Error!');
                }
            });
        }
        else {
            $.ajax({
                method: 'GET',
                dataType: 'html',
                url: '/courses/' + course_id + '/history',
                success: function (response) {
                    $("#content").html(response);
                },
                error: function (e) {
                    alert("Error!");
                }
            });
        }
    });
});
