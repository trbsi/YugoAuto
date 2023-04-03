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
