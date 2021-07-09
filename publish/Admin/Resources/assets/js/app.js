
function showNotification(message, typeAlert) {
    typeAlert = typeof typeAlert !== 'undefined' ? typeAlert : 'success';
    let color = {
        'primary': {color: 'primary' , icon: 'add_alert' },
        'info': {color: 'info', icon: 'add_alert' },
        'error': {color:'danger', icon : 'error' },
        'success': {color:'success', icon : 'check_circle' },
        'warning': {color:'warning', icon : 'add_alert' },
    };
    let type = color[typeAlert]['color'];
    let icon = color[typeAlert]['icon'];

    $.notify({
        icon: icon,
        message: message

    }, {
        type: type,
        timer: 4000,
        z_index: 1051,
        placement: {
            from: 'top',
            align: 'right'
        }
    });
}

window.showNotification = showNotification;
