//SAVE PUSH TOKEN
function savePushToken(
    token,
    deviceId,
    platform
) {

    var data = {
        token: token,
        deviceId: deviceId,
        platform: platform
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/push-token',
        data: data,
        success: function (data) {
        },
        dataType: 'json'
    });
}

function sendRequest(
    type,
    url,
    data,
    onSuccessCallback = function () {
    }
) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: type,
        url: url,
        data: data,
        success: function (data) {
            onSuccessCallback();
        },
        error: function (xhr, status, exception) {
            Swal.fire({
                text: xhr.responseJSON.message,
                icon: 'warning',
                confirmButtonText: 'OK',
            });
        },
        dataType: 'json'
    });
}
