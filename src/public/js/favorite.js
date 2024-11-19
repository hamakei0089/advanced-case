$(document).ready(function () {

    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('.favorite-btn').click(function() {
        var button = $(this);
        var storeId = button.closest('.store__row').data('store-id');
        var isFavorite = button.data('favorite');

        $.ajax({
            url: '/stores/' + storeId + '/favorite',
            method: 'POST',
            data: {
                _token: csrfToken,
            },
            success: function(response) {
                button.data('favorite', !isFavorite);
                button.html(isFavorite ? '♡' : '❤️');
                button.toggleClass('bg-red-500 hover:bg-red-700 bg-blue-500 hover:bg-blue-700');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
