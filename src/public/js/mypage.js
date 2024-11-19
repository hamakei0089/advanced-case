$(document).ready(function() {

    $('.favorite-btn').click(function() {
        var button = $(this);
        var storeId = button.closest('.favorite__row').data('store-id');
        var isFavorite = button.data('favorite');

    $.ajax({
        url: '/stores/' + storeId + '/favorite',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(response) {
            isFavorite = !isFavorite;
            button.data('favorite', isFavorite);
            button.html(isFavorite ? '❤️' : '♡');
            button.toggleClass('bg-red-500 hover:bg-red-700 bg-blue-500 hover:bg-blue-700');
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
});

    $('.review-section').each(function() {
        var section = $(this);
        var reservationDatetime = new Date(section.data('datetime'));
        var currentDatetime = new Date();

        if (currentDatetime > reservationDatetime) {
            section.find('.review-btn').show();
        }
    });
});
