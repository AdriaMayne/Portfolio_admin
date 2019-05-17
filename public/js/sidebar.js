$(function() {
    var navState = true;

    $('#navController').on('click', function() {
        if (navState) {
            navState = !navState;

            $('#mySidenav').css({
                width : "250px"
            });
            $('main').css({
                marginLeft : "250px"
            });
        } else {
            navState = !navState;

            $('#mySidenav').css({
                width : "0"
            });
            $('main').css({
                marginLeft : "0"
            });
        }
    })
});
