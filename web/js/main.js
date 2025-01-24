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
});
