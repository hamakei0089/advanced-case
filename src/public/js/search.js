
    $('#search-box, #area-filter, #genre-filter').on('input change', function () {
        var searchValue = $('#search-box').val().toLowerCase();
        var areaFilter = $('#area-filter').val();
        var genreFilter = $('#genre-filter').val();

        $('.store__row').each(function () {
            var place = $(this).data('area').toLowerCase(); // 修正
            var genre = $(this).data('genre').toLowerCase();
            var storeName = $(this).find('.store-name__cell').text().toLowerCase();

            var matchesSearch = storeName.includes(searchValue);
            var matchesArea = areaFilter === 'all' || place === areaFilter.toLowerCase();
            var matchesGenre = genreFilter === 'all' || genre === genreFilter.toLowerCase();

            if (matchesSearch && matchesArea && matchesGenre) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });