$(".row button").on('click', function () {
    var subject_id = this.id;
    subject_id = subject_id.replace('history', '');
    var content = "#target" + subject_id;
    $.ajax({
        method: 'POST',
        dataType: 'html',
        data: {
            subject_id: subject_id,
        },
        url: '/subjects/' + subject_id + '/history',
        success: function (response) {
            $(content).html(response);
        },
        error: function (e) {
            alert('Error!');
        }
    });
});
