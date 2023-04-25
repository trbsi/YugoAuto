//AUTOCOMPLETE FOR PLACES
$(function () {
    let tokenInputSettings = {
        theme: 'facebook',
        minChars: 3,
        hintText: transTypeInCity,
        resultsLimit: 5,
        tokenLimit: 1,
        queryParam: 'term'
    };

    var fromPlaceInput = $("#from_place");
    var fromPlaceId = $("#from_place_id");
    fromPlaceInput.tokenInput(citySearchRoute,
        {
            ...tokenInputSettings,
            onAdd: function (item) {
                fromPlaceId.val(item.id);
            },
            onDelete: function (item) {
                fromPlaceId.val('');
            }
        }
    );

    var currentUrl = window.location.href;
    var toPlaceIds = [];
    var toPlaceInput = $("#to_place");
    var toPlaceId = $("#to_place_id");
    toPlaceInput.tokenInput(citySearchRoute, {
        ...tokenInputSettings,
        ...{tokenLimit: (currentUrl.indexOf('ride/create') !== -1) ? 1 : 5},
        onAdd: function (item) {
            toPlaceIds.push(item.id);
            toPlaceId.val(toPlaceIds.join(','));
        },
        onDelete: function (item) {
            toPlaceIds = toPlaceIds.filter(function (elem) {
                return elem !== item.id;
            });
            toPlaceId.val(toPlaceIds.join(','));
        }
    });

    //SWITCH RIDES
    $('#switch_rides').click(function () {
        //switch places ids
        var tmpToPlaceId = toPlaceId.val();
        toPlaceId.val(fromPlaceId.val());
        fromPlaceId.val(tmpToPlaceId);

        //clear array because onAdd() function will be triggered
        toPlaceIds = [];

        //switch token input valus
        var tmpToPlaceInput = toPlaceInput.tokenInput('get');
        toPlaceInput.tokenInput('clear');
        (fromPlaceInput.tokenInput('get')).forEach(function (element) {
            toPlaceInput.tokenInput('add', element);
        })

        fromPlaceInput.tokenInput('clear');
        if (tmpToPlaceInput.length > 0) {
            fromPlaceInput.tokenInput('add', tmpToPlaceInput[0]);
        }
    });
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


//MODAL
//values in array corresponds to modalClass in custom-modal-content.blade.php
let modals = ['newcities-and-lastmincancel', 'driverprofile', 'package-and-passenger-restriction'];
$.each(modals, function (index, modalClass) {
    const modal = $('.custom-modal-' + modalClass)
    if (modal.length === 0) {
        return;
    }

    var localStorageItem = 'modalClosed-' + modalClass;
    if (!localStorage.getItem(localStorageItem)) {
        modal.show();
    }
    $('.custom-modal-button-' + modalClass).click(function () {
        modal.hide();
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
