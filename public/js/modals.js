$('#modalTestimonials').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);

    // Info
    var id = button.data('id');
    var name = button.data('name');
    var title = button.data('title');
    var message = button.data('message');

    var action = button.data('action');
    var modal = $(this);
    var html = "<h5>" + id + " - " + title + "</h5><blockquote class='blockquote text-right'><p class='mb-0'>" + message + "</p><footer class='blockquote-footer'>" + name + "</footer></blockquote>";

    $('#modal-form').attr('action', action);
    modal.find('.modal-body').html(html);
});

$('#modalProjects').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);

    // Info
    var id = button.data('id');
    var title = button.data('title');
    var action = button.data('action');
    var modal = $(this);

    $('#modal-form').attr('action', action);
    modal.find('.modal-body').text(id + ' - ' + title);
});

$('#modalTags').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);

    // Info
    var id = button.data('id');
    var title = button.data('title');
    var action = button.data('action');
    var modal = $(this);

    $('#modal-form').attr('action', action);
    modal.find('.modal-body').text(id + ' - ' + title);
});

$('#modalLanguages').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);

    // Info
    var id = button.data('id');
    var name = button.data('name');
    var action = button.data('action');
    var modal = $(this);

    $('#modal-form').attr('action', action);
    modal.find('.modal-body').text(id + ' - ' + name);
});

$('#modalTestNew').on('show.bs.modal', function (event) {
    // Info
    var imageUrl = $('#thumbnail').attr('src');
    var modal = $(this);

    modal.find('.modal-content').css('background-image', 'url(' + imageUrl + ')');
});
