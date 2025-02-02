class Favorites {
    static URL_ACTIONS = '/favorites';

    init() {
        this.updElements();
        this.Events();
    }

    Events() {
        let favorites = this;
        $(document).on('click', '.product-favorites [data-action_type]', function() {
            let prod_id =  $(this).data('prod_id');
            let $el = $(this);
            favorites.runAction($(this).data(), (response) => {
                if ($(this).data('action_type') == 'add') {
                    $el.addClass('active');
                    $el.data('action_type', 'remove');
                } else {
                    $el.removeClass('active');
                    $el.data('action_type', 'add');
                }
            });
        });
    }

    updElements() {
        let favorites = this;
        let buttons = $('.product-favorites [data-action_type]');
        if (buttons.length < 1) {
            return false;
        }

        favorites.runAction({action_type: 'get'}, (resp) => {
            if (resp.products) {
                buttons.each(function() {
                    let prod_id = $(this).data('prod_id');
                    let $el = $(this);

                    if (resp.products && typeof(resp.products[prod_id]) !== 'undefined') {
                        $el.addClass('active');
                        $el.data('action_type', 'remove');
                    }
                });
            }
        });
    }


    runAction(data, callback) {
        $.ajax({
            url: Favorites.URL_ACTIONS,
            type: 'post',
            dataType: 'json',
            data: data,
            success: function (response) {
                if (response.status) {
                    callback(response);
                } else {
                    alert('Произошла ошибка при обновлении данных');
                }
            }, error: function () {
                alert('Произошла ошибка при обновлении данных');
            }
        });
    }
}

