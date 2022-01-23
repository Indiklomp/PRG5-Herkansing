$(function( $ ){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let bookId = $(this).data('id');

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/recommend",
            data: {'status': status, 'book_id': bookId},
            success: function (data) {
        }
        });
    });
});
