$(function(){
    $('.btn-cart').mouseover(function() {

    });

    $(".btn-cart, #cart_modal").hover(function(){
        if (!$('.btn-cart').hasClass('active')) {
            return false;
        }
        if (!$('#cart_modal .modal-body').html()) {
            $.ajax({
                url: '/cart/actions',
                type: 'post',
                dataType: 'html',
                data: {action_type: 'get'},
                success: function (html) {
                    if (html) {
                        $('#cart_modal .modal-body').html(html);
                    }
                }
            });
        }

        $('#cart_modal').modal({backdrop: false});
    },function(){
        $('#cart_modal').modal('hide');
    });

    $(document).on('click', '.cart [data-action_type], .product-by [data-action_type]', function(e) {
        e.preventDefault();
        let action_type = $(this).data('action_type');
        let prod_id = typeof($(this).data('prod_id')) !== 'undefined' ? $(this).data('prod_id') : '';

        $.ajax({
            url: '/cart/actions',
            type: 'post',
            dataType: 'html',
            data: {action_type: action_type, prod_id: prod_id},
            success: function (html) {
                $('#cart_modal .modal-body').html(html);
                let cart_title = '<span>Корзина</span>';

                if (html) {
                    $('header .btn-cart').addClass('active');
                    let price = $(html).find('.cart-sum').text();
                    cart_title = `<span class="cart-sum">${price}</span>`;
                    $('#cart_modal').modal({backdrop: false});
                } else {
                    $('header .btn-cart').removeClass('active');
                    $('#cart_modal').modal('hide');
                }
                $('header .btn-cart .btn-title').html(cart_title);
            },
            error: function () {
                alert('Произошла ошибка при очищении корзины');
            }
        });
    });
});
