$(function() {
    var video = $('#video').get(0);
    var AdriaMayne_logo = $('#AdriaMayne_logo');
    var CookingMate_logo = $('#CookingMate_logo');
    var Adami_logo = $('#Adami_logo');
    var Petlinks_logo = $('#Petlinks_logo');

    AdriaMayne_logo.on('click', function() {
        video.currentTime = 0;
        video.play();
    });

    CookingMate_logo.on('click', function() {
        video.currentTime = 5;
        video.play();
    });

    Adami_logo.on('click', function() {
        video.currentTime = 16;
        video.play();
    });

    Petlinks_logo.on('click', function() {
        video.currentTime = 32;
        video.play();
    });
});
