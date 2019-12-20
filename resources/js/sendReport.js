$(".formReport button").on('click', function () {
    var task_id = this.id;
    task_id = task_id.replace('task', '');
    var report = "#report" + task_id;
    var btn = "#btn" + task_id;
    var reportContent = $(report).val();
    var btnSend = "#task" + task_id;
    $.ajax({
        type: 'POST',
        url: '/report/store',
        data: {
            task_id: task_id,
            report: reportContent,
        },
        success: function (response) {
            $(btn).removeClass('btn-info');
            $(btn).addClass('btn-warning');
            $(btn).text('Waiting');
            $(report).val(reportContent);
            $(btnSend).remove();
        },
        error: function(e) {
            alert("Error!");
        }
    });
});
