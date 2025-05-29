// For Add or Remove Flight Multi City Option Start
$(document).ready(function () {
    const weekdaysm = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const todaym = new Date();
     let formCounter = 2;

    // Function to initialize flatpickr for a date input
    function initDatePicker(dateInput) {
        const journeyDayEl = dateInput.closest('.Journey_datem').querySelector('.journeyDaym');
        const tomorrow = new Date();
        tomorrow.setDate(todaym.getDate() + 1);

        // Set initial weekday (tomorrow's day)
        journeyDayEl.innerText = weekdaysm[tomorrow.getDay()];

        // Initialize flatpickr
        flatpickr(dateInput, {
            dateFormat: "d M Y",
            defaultDate: tomorrow,
            minDate: todaym,
            onChange: function(selectedDates) {
                if (selectedDates[0]) {
                    journeyDayEl.innerText = weekdaysm[selectedDates[0].getDay()];
                }
            }
        });
    }

    // Initialize existing date pickers
    document.querySelectorAll('.datepickerm').forEach(picker => {
        initDatePicker(picker);
    });

    $("#addMulticityRow").on('click', function() {
        let currentCount = document.querySelectorAll('.multi_city_form').length;

        if (currentCount === 5) {
            alert("Maximum 5 cities allowed!");
            return;
        }
        formCounter++;
        const newFormNumber = formCounter;

        // Create new flight form HTML
        const newFormHtml = `<div class="multi_city_form">
            <div class="row">
                <div class="col-lg-12">
                    <div class="multi_form_remove">
                        <button type="button" id="remove_multi_city">Remove</button>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="flight_Search_boxed">
                        <p>From</p>
                        <input type="text" class="formplace${newFormNumber}"
                            value="" placeholder="Leaving from"
                            id="formplacemulti${newFormNumber}">
                        <span>Leaving from</span>
                        <div class="plan_icon_posation">
                            <i class="fas fa-plane-departure"></i>
                        </div>
                    </div>
                    <div class="searchlist" id="searchlistmulti${newFormNumber}"></div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="flight_Search_boxed">
                        <p>To</p>
                        <input type="text" class="toplace${newFormNumber}"
                            value="" placeholder="Going to"
                            id="toplacemulti${newFormNumber}">
                        <span>Going to</span>
                        <div class="plan_icon_posation">
                            <i class="fas fa-plane-arrival"></i>
                        </div>
                        <div class="range_plan">
                            <i class="fas fa-exchange-alt" onclick="textSwaps(${newFormNumber})"></i>
                        </div>
                    </div>
                    <div class="searchlist" id="searchlistmultito${newFormNumber}"></div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="form_search_date">
                        <div class="flight_Search_boxed date_flex_area">
                            <div class="Journey_datem">
                                <p>Journey date</p>
                                <i class="fas fa-calendar"></i>
                                <input type="text" class="datepickerm" value="">
                                <span class="journeyDaym"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;

        // Append new form
        const $newForm = $(newFormHtml);
        $(".multi_city_form_wrapper").append($newForm);

        // Initialize date picker for the new form
        const newDateInput = $newForm.find('.datepickerm')[0];
        initDatePicker(newDateInput);

        // Hide "Add another flight" button if we've reached 5
        if (currentCount + 1 === 5) {
            $("#addMulticityRow").hide();
        }
    });

    // Remove Button Click
    $(document).on('click', function(e) {
        if (e.target.id === "remove_multi_city") {
            $(e.target).parent().closest('.multi_city_form').remove();
            // Show "Add another flight" button when a form is removed
            $("#addMulticityRow").show();
        }
    });
});
