
$('.btn-add,.btn-subtract').on('click touchstart', function () {

    const qadult = $('#f-qadult').val();
    const qchild = $('#f-qchild').val();
    const qinfant = $('#f-qinfant').val();

    $('.qstring').text(` ${qadult} Adults - ${qchild} Childs - ${qinfant} Infants`);
    event.stopPropagation();
    event.preventDefault();
});



function addValue(a) {
    $('.final-count').text(`${a} Passenger`);
}

var i = 1; // Adult (min 1)
var j = 0; // Children
var k = 0; // Infants

function getTotal() {
    return i + j + k;
}

$('.btn-add').on('click touchstart', function () {
    if (getTotal() < 6) {
        const value = ++i;
        $('.pcount').text(`${value}`);
        addValue(getTotal());
        $('.errormsg').text("");
    } else {
        $('.errormsg').text("Maximum of 6 total passengers allowed.");

    }
    event.stopPropagation();
    event.preventDefault();
});

$('.btn-subtract').on('click touchstart', function () {
    if (i > 1) {
        const value = --i;
        $('.pcount').text(`${value}`);
        addValue(getTotal());
    } else {
        $('.pcount').text(1);
        addValue(getTotal());
    }
    event.stopPropagation();
    event.preventDefault();
});

$('.btn-add-c').on('click touchstart', function () {
    if (j < 5 && getTotal() < 6) {
        const value = ++j;
        $('.ccount').text(`${value}`);
        addValue(getTotal());
        $('.errormsg').text("");
    }  else {
        $('.errormsg').text("Maximum of 6 total passengers allowed.");
    }
    event.stopPropagation();
    event.preventDefault();
});

$('.btn-subtract-c').on('click touchstart', function () {
    if (j > 0) {
        const value = --j;
        $('.ccount').text(`${value}`);
        addValue(getTotal());
    }
    event.stopPropagation();
    event.preventDefault();
});

$('.btn-add-in').on('click touchstart', function () {
    if (k < 2 && getTotal() < 6) {
        const value = ++k;
        $('.incount').text(`${value}`);
        addValue(getTotal());
        $('.errormsg').text("");
    } else {
        $('.errormsg').text("Maximum of 6 total passengers allowed.");
    }
    event.stopPropagation();
    event.preventDefault();
});

$('.btn-subtract-in').on('click touchstart', function () {
    if (k > 0) {
        const value = --k;
        $('.incount').text(`${value}`);
        addValue(getTotal());
    }
    event.stopPropagation();
    event.preventDefault();
})



$(document).ready(function () {
    $('.cabin-list button').click(function () {
        event.stopPropagation();
        event.preventDefault();
        $('.cabin-list button.active').removeClass("active");
        $(this).addClass("active");
    });
});
