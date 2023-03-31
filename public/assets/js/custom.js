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
    $('#datetimepicker').datetimepicker(
        {
            format: 'd.m.Y H:i',
            minDate: 0,
        }
    );

    $('#datepicker').datetimepicker(
        {
            format: 'd.m.Y',
            minDate: 0,
            timepicker: false
        }
    );
});
