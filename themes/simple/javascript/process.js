
getCurrentWeekDates();


function getCurrentWeekDates() {
    let currentDate = new Date;
    let currentYear = currentDate.getFullYear();
    let currentMonth  = currentDate.getMonth();
    let currentDay = currentDate.getDate();
    let remainingDays =5;
    var weekDayDom = $('#dateList');
    let dates = [];
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    for(let i=0; i<=remainingDays; i++){
        let newDate = new Date(currentYear,currentMonth, currentDay + i);
        $('<button/>')
            .addClass('btn btn-outline-primary')
            .text(newDate.toLocaleDateString('en-US',options))
            .data('date',newDate.toLocaleDateString())
            .on('click',selectedDate)
            .appendTo(weekDayDom);
    }
}

function selectedDate(e){
    e.preventDefault();
    console.log($(e.target).data());
    let clickedDate = $(e.target).data();
    let [month,date,year] = clickedDate['date'].split('/');
    let dateParam = `${year}-${month}-${date}`;
    let baseUrl = 'http://localhost:81/bikerental/apibike/bikes/';
    let url = `${baseUrl}${dateParam}` ;
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
