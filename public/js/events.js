var defaultImage = $('#thumbnail').attr('src');
var defaultImgLabel = "Seleccionar Archivo";

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

$('input[type="checkbox"]').change(function(){
    this.value = (Number(this.checked));
});

$('#percentage').on('input', function() {
    rangeSlider();
});

function rangeSlider() {
    var element = $('#percentage');
    var total = element.val();
    var defaultLabel = "Porcentaje * - ";

    $('#percentageRangeLabel').text(defaultLabel + total + "%");
}

rangeSlider();
