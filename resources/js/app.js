require('./bootstrap');

$(document).ready(function () {
    $('#date').click(function () {
        $('.date').toggleClass('fa-sort-amount-up');
    });
    $('#title').click(function () {
        $('.title').toggleClass('fa-sort-amount-up');
    });
});
