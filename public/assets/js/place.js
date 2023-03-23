$(function () {

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

});


$(document).ready(function () {
    $('#time').datetimepicker(
        {
            format: 'd.m.Y H:i',
            minDate: 0
        }
    );
});
