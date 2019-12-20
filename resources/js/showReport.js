$("td button").on('click', function () {
    var task_id = this.id;
    task_id = task_id.replace('task', '');
    var report = "#report" + task_id;
    $.ajax({
        type: 'POST',
        url: '/report/show',
        data: {
            task_id: task_id,
        },
        success: function (response) {
            $(report).val(response.result[0].report);
        },
        error: function(e) {
            alert("Error! Please refresh");
        }
    });
});

$("td a").on('click', function () {
    var task_id = this.id;
    task_id = task_id.replace('cmt', '');
    var comment = "#comment" + task_id;
    $.ajax({
        type: 'POST',
        url: '/report/show',
        data: {
            task_id: task_id,
        },
        success: function (response) {
            $(comment).val(response.result[0].cmt);
        },
        error: function(e) {
            alert("Error! Please refresh");
        }
    });
});
