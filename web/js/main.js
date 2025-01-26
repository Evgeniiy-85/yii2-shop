$(function(){
    $('.products-list .product-by .button').click(function() {
        let prod_id = $(this).data('prod_id');
        let quantity = $(this).data('quantity');
        $.ajax({
            url: '/basket/add',
            type: 'post',
            dataType: 'html',
            data: {prod_id: prod_id, quantity: quantity},
            success: function (html) {
                if (html) {
                    $('#basket_modal .modal-body').html(html);
                    $('#basket_modal').modal();
                } else {
                    alert('Произошла ошибка при обновлении корзины');
                }
            },
            error: function () {
                alert('Произошла ошибка при обновлении корзины');
            }
        });
    });

    $(document).on('click', '.basket-product-quantity_picker, .basket-product_remove', function(e) {
        e.preventDefault();
        let prod_id = $(this).data('prod_id');
        let quantity = 0;
        let $quantity = $(this).closest('.basket-product').find('.basket-product-quantity');

        if (!$(this).hasClass('basket-product_remove')) {
            let action_type = $(this).data('action_type');
            quantity = Number($quantity.text());
            quantity += action_type == 'reduce' ? -1 : 1;
        }

        $.ajax({
            url: '/basket/quantity-change',
            type: 'post',
            dataType: 'html',
            data: {prod_id: prod_id, quantity: quantity},
            success: function (html) {
                if (html) {
                    $quantity.text(quantity);
                    $('#basket_modal .modal-body').html(html);
                    if ($('.basket-product').length < 1) {
                        $('#basket_modal').modal('hide');
                    }
                } else {
                    alert('Произошла ошибка при обновлении корзины');
                }
            },
            error: function () {
                alert('Произошла ошибка при обновлении корзины');
            }
        });
    });

    $(document).on('click', '.basket-products_remove', function(e) {
        e.preventDefault();
        let prod_id = $(this).data('prod_id');

        $.ajax({
            url: '/basket/remove',
            type: 'post',
            dataType: 'html',
            data: {products: 'all'},
            success: function (result) {
                if (result) {
                    $('#basket_modal').modal('hide');
                } else {
                    alert('Произошла ошибка при очищении корзины');
                }
            },
            error: function () {
                alert('Произошла ошибка при очищении корзины');
            }
        });
    });
});
