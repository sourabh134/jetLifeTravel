
$('.btn-add,.btn-subtract').on('click touchstart', function () {

    const qadult = $('#f-qadult').val();
    const qchild = $('#f-qchild').val();
    const qinfant = $('#f-qinfant').val();

    $('.qstring').text(` ${qadult} Adults - ${qchild} Childs - ${qinfant} Infants`);
    event.stopPropagation();
    event.preventDefault();
});



function addValue(a) {
    const sum = a++;
    $('.final-count').text(`${sum} Passenger`);
}

var i = 1;
var j = 0;
var k = 0;

$('.btn-add').on('click touchstart', function () {
    const value = ++i;
    $('.pcount').text(`${value}`);
    addValue(value+j+k);
    event.stopPropagation();
    event.preventDefault();
});


$('.btn-subtract').on('click touchstart', function () {
    if (i == 1) {
        $('.pcount').text(1);
        addValue(1);

    } else {
        const value = --i;
        $('.pcount').text(`${value}`);
        addValue(value+j+k);
    }
    event.stopPropagation();
    event.preventDefault();
});


$('.btn-add-c').on('click touchstart', function () {
    if (j < 4) {
        const value = ++j;
        $('.ccount').text(`${value}`);
        addValue(value + i + k);
        if (j === 4) {
            $(this).prop('disabled', true); // disable the button
        }
    }
    event.stopPropagation();
    event.preventDefault();
    // const value = ++j;
    // $('.ccount').text(`${value}`);
    // addValue(value+i+k);
    // event.stopPropagation();
    // event.preventDefault();
});


$('.btn-subtract-c').on('click touchstart', function () {
    if (j > 0) {
        const value = --j;
        $('.ccount').text(`${value}`);
        addValue(value + i + k);

        // Re-enable add button when going below 4
        $('.btn-add-c').prop('disabled', false);
    }

    event.stopPropagation();
    event.preventDefault();
    // if (j == 0) {
    //     $('.ccount').text(0);
    //     addValue(1);
    // } else {
    //     const value = --j;
    //     $('.ccount').text(`${value}`);
    //     addValue(value+i+k);
    // }
    // event.stopPropagation();
    // event.preventDefault();
});



$('.btn-add-in').on('click touchstart', function () {
    if (k < 2) {
        const value = ++k;
        $('.incount').text(`${value}`);
        addValue(value+i+j);
        if (k === 2) {
            $(this).prop('disabled', true); // disable the button
        }
    }
    event.stopPropagation();
    event.preventDefault();
});


$('.btn-subtract-in').on('click touchstart', function () {
    if (k > 0) {
        const value = --k;
        $('.incount').text(`${value}`);
        addValue(value + i + j);

        // Re-enable add button when going below 4
        $('.btn-add-in').prop('disabled', false);
    }

    event.stopPropagation();
    event.preventDefault();
    // if (k == 0) {
    //     $('.incount').text(0);
    //     addValue(1);
    // } else {
    //     const value = --k;
    //     $('.incount').text(`${value}`);
    //     addValue(value+i+j);
    // }
    // event.stopPropagation();
    // event.preventDefault();
});



$(document).ready(function () {
    $('.cabin-list button').click(function () {
        event.stopPropagation();
        event.preventDefault();
        $('.cabin-list button.active').removeClass("active");
        $(this).addClass("active");
    });
});
