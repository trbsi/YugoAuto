//AUTOCOMPLETE FOR PLACES
$(function () {

    if ($("#from_place").length) {
        $("#from_place").autocomplete({
            minLength: 3,
            source: "/api/place/search",
            focus: function (event, ui) {
                $("#from_place").val(ui.item.label);
                return false;
            },
            select: function (event, ui) {
                $("#from_place_id").val(ui.item.value);
                $("#from_place").val(ui.item.label);
                return false;
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append("<div>" + item.label + "</div>")
                .appendTo(ul);
        };
    }

    if ($("#to_place").length) {
        $("#to_place").autocomplete({
            minLength: 3,
            source: "/api/place/search",
            focus: function (event, ui) {
                $("#to_place").val(ui.item.label);
                return false;
            },
            select: function (event, ui) {
                $("#to_place_id").val(ui.item.value);
                $("#to_place").val(ui.item.label);
                return false;
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append("<div>" + item.label + "</div>")
                .appendTo(ul);
        };
    }

});

//DATE TIME PICKER
$(document).ready(function () {
    $('.datetimepicker').datetimepicker(
        {
            format: dateTimePickerFormat,
            step: 15,
            minDate: 0,
            dayOfWeekStart: 1,
        }
    );

    $('.datepicker').datetimepicker(
        {
            format: datePickerFormat,
            minDate: 0,
            timepicker: false,
            dayOfWeekStart: 1,
        }
    );
});


//CLEAR INPUTS ON FOCUS
$('.clear-input').on('click focusin', function () {
    this.value = '';
});


//SWITCH RIDES
$('#switch_rides').click(function () {
    var fromPlace = $('#from_place');
    var fromPlaceId = $('#from_place_id');
    var toPlace = $('#to_place');
    var toPlaceId = $('#to_place_id');

    var tmpFromPlaceValue = fromPlace.val();
    var tmpFromPlaceIdValue = fromPlaceId.val();

    fromPlace.val(toPlace.val());
    fromPlaceId.val(toPlaceId.val());

    toPlace.val(tmpFromPlaceValue);
    toPlaceId.val(tmpFromPlaceIdValue);
});

//MODAL
//values in array corresponds to modalClass in custom-modal-content.blade.php
let modals = [/*'appstoreinfo',*/ 'driverprofile'];
$.each(modals, function (index, modalClass) {
    var localStorageItem = 'modalClosed-' + modalClass;
    if (!localStorage.getItem(localStorageItem)) {
        $('.custom-modal-' + modalClass).show();
    }
    $('.custom-modal-button-' + modalClass).click(function () {
        $('.custom-modal-' + modalClass).hide();
        localStorage.setItem(localStorageItem, true);
    });
});

//ON FORM SUBMIT
$(".formOnSubmitAsk").on('click', function (event) {
    event.preventDefault(); // prevent the default form submission
    var $this = $(this);

    Swal.fire({
        title: areYouSureTitle,
        showCancelButton: true,
        confirmButtonText: 'OK',
    }).then((result) => {
        if (result.isConfirmed) {
            $this.closest('form').submit();
        }
    });
});
