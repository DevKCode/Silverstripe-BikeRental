console.log('loaded external file');
getCurrentWeekDates();


function getCurrentWeekDates() {
    console.log('get currentt dates');
    let currentDate = new Date;
    let currentYear = currentDate.getFullYear();
    let currentMonth  = currentDate.getMonth();
    let currentDay = currentDate.getDate();
    let remainingDays = currentDate.getDay() + 4;
    var weekDayDom = $('#dateList');
    console.log(weekDayDom);
    let dates = [];
    for(let i=0; i<=remainingDays; i++){
        let newDate = new Date(currentYear,currentMonth, currentDay + i);
        console.log(newDate.toLocaleDateString());
        $('<button/>')
            .addClass('btn btn-outline-primary')
            .text(newDate.toLocaleDateString())
            .on('click',selectedDate)
            .appendTo(weekDayDom);
    }
}

function selectedDate(e){
    e.preventDefault();
    console.log($(e.target).text());
    let url = 'http://localhost:81/bikerental/apibike/bikes/';
    console.log('url', url);

    $.ajax({
        url: url
    }).done(function (e) {

        $('#view').html(e);
        })
        .fail(function (error) {
              console.error('error', error)
        });




}
// function ajaxcall() {
//     let url = 'http://localhost:81/bikerental/apibike/bikes/';
//     $.ajax({
//         type:"GET",
//         url = url,
//         contentType: "application/json; charset=utf-8",
//         dataType: "json",
//         success: function(response){
//             console.log(response.d);
//         },
//         failure: function (response) {
//             console.log(response.d);
//         }
//     });
// }
