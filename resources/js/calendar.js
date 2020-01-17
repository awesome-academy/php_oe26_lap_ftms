var calendarEvents = new Array();
var subjects = $("#subject-calendar").val();
subjects = JSON.parse(subjects);
for (var i = 0; i < subjects.length; i++) {
    calendarEvents[i] = {
        'title': subjects[i]['name'],
        'start': subjects[i]['created_at'].slice(0, 10),
        'end': subjects[i]['updated_at'].slice(0, 10),
        'textColor': 'black',
        'backgroundColor': subjects[i]['color'],
    };
}
