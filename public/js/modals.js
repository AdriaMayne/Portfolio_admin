$('#modalTestimonials').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var name = button.data('name');
    var title = button.data('title');
    var message = button.data('message');

    var action = button.data('action');
    var modal = $(this);
    var html = "<h5>" + id + " - " + title + "</h5><blockquote class='blockquote text-right'><p class='mb-0'>" + message + "</p><footer class='blockquote-footer'>" + name + "</footer></blockquote>";

    $('#modal-form').attr('action', action);
    modal.find('.modal-body').html(html);
})
