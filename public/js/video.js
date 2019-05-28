$(function() {
    var video = $('#video').get(0);
    var AdriaMayne_logo = $('#AdriaMayne_logo');
    var CookingMate_logo = $('#CookingMate_logo');
    var Adami_logo = $('#Adami_logo');
    var Petlinks_logo = $('#Petlinks_logo');

    var AdriaMayneStart = 0;
    var CookingMateStart = 5;
    var AdamiStart = 16;
    var PetlinksStart = 32;

    AdriaMayne_logo.on('click', function() {
        video.currentTime = AdriaMayneStart;
        video.play();
    });

    CookingMate_logo.on('click', function() {
        video.currentTime = CookingMateStart;
        video.play();
    });

    Adami_logo.on('click', function() {
        video.currentTime = AdamiStart;
        video.play();
    });

    Petlinks_logo.on('click', function() {
        video.currentTime = PetlinksStart;
        video.play();
    });

    function between(x, min, max) {
        return x >= min && x < max;
    }

    $('#video').on('timeupdate', function() {
        var current = video.currentTime;

        if (between(current, AdriaMayneStart, CookingMateStart)) {
            $('.images *').removeClass('highlight');
            AdriaMayne_logo.addClass('highlight');
        } else if (between(current, CookingMateStart, AdamiStart)) {
            $('.images *').removeClass('highlight');
            CookingMate_logo.addClass('highlight');
        } else if (between(current, AdamiStart, PetlinksStart)) {
            $('.images *').removeClass('highlight');
            Adami_logo.addClass('highlight');
        } else if (between(current, PetlinksStart, video.duration)) {
            $('.images *').removeClass('highlight');
            Petlinks_logo.addClass('highlight');
        } else {
            $('.images *').removeClass('highlight');
        }
    });
});
