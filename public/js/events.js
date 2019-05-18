var defaultImage = $('#thumbnail').attr('src');
var defaultImgLabel = $(".custom-file-label").text();

$("#image").change(function (){
    var fileName = $(this).val();
    $(".custom-file-label").html(fileName);
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#thumbnail').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        $('#thumbnail').attr('src', defaultImage);
        $(".custom-file-label").html(defaultImgLabel);
    }
}
