$(function(){
    $('.products-list .product-by .button').click(function() {
        let prod_id = $(this).data('prod_id');
        let quantity = $(this).data('quantity');
        $.ajax({
            url: '/cart/add',
            type: 'post',
            dataType: 'html',
            data: {prod_id: prod_id, quantity: quantity},
            success: function (html) {
                if (html) {
                    $('#cart_modal .modal-body').html(html);
                    $('#cart_modal').modal();
                } else {
                    alert('Произошла ошибка при обновлении корзины');
                }
            },
            error: function () {
                alert('Произошла ошибка при обновлении корзины');
            }
        });
    });

    $(document).on('click', '.cart-product-quantity_picker, .cart-product_remove', function(e) {
        e.preventDefault();
        let prod_id = $(this).data('prod_id');
        let quantity = 0;
        let $quantity = $(this).closest('.cart-product').find('.cart-product-quantity');

        if (!$(this).hasClass('cart-product_remove')) {
            let action_type = $(this).data('action_type');
            quantity = Number($quantity.text());
            quantity += action_type == 'reduce' ? -1 : 1;
        }

        $.ajax({
            url: '/cart/change',
            type: 'post',
            dataType: 'html',
            data: {prod_id: prod_id, quantity: quantity},
            success: function (html) {
                if (html) {
                    $quantity.text(quantity);
                    $('#cart_modal .modal-body').html(html);
                    if ($('.cart-product').length < 1) {
                        $('#cart_modal').modal('hide');
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

    $(document).on('click', '.cart-products_remove', function(e) {
        e.preventDefault();
        let prod_id = $(this).data('prod_id');

        $.ajax({
            url: '/cart/remove',
            type: 'post',
            dataType: 'html',
            data: {products: 'all'},
            success: function (result) {
                if (result) {
                    $('#cart_modal').modal('hide');
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
