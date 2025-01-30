$(function(){
    $('.btn-cart').mouseover(function() {

    });

    $(".btn-cart, #cart_modal").hover(function(){
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

                if (html) {
                    $('header .btn-cart').addClass('active');
                    $('#cart_modal').modal({backdrop: false});
                } else {
                    $('header .btn-cart').removeClass('active');
                    $('#cart_modal').modal('hide');
                }
            },
            error: function () {
                alert('Произошла ошибка при очищении корзины');
            }
        });
    });
});
