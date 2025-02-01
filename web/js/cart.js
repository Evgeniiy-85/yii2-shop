class Cart {

    static URL_ACTIONS = '/cart/actions';

    constructor() {

    }


    init() {
        this.loadModal();
        this.Events();
    }

    Events() {
        let Cart = this;
        $(document).on('click', '.cart [data-action_type], .product-by [data-action_type]', function() {
            let $el = $(this);
            let data = $(this).data();

            Cart.runAction(data, (html) => {
                Cart.updCart(html);
                Cart.updProdButton($el, html);
            });
        });
    }

    updCart(html) {
        let cart_title = '<span>Корзина</span>';
        if (html) {
            let price = $(html).find('.cart-sum').text();
            cart_title = `<span class="cart-sum">${price}</span>`;
            $('#cart_modal').addClass('active').find('.modal-body').html(html);
        } else {
            $('#cart_modal').removeClass('active').find('.modal-body').html(html);
        }

        $('.btn-cart .btn-title').html(cart_title);
    }

    updProdButton($el, html) {
        if ($el.parent('.product-by').length > 0) {
            if (html) {
                $el.html('В корзине');
                $el.addClass('active');
            } else {
                $el.html('Купить');
                $el.removeClass('active');
            }
        }
    }

    loadModal() {
        let Cart = this;
        this.runAction({action_type:'get'}, (html) => {
            Cart.updCart(html);
        });
    }


    runAction(data, callback) {
        $.ajax({
            url: Cart.URL_ACTIONS,
            type: 'post',
            dataType: 'html',
            data: data,
            success: function (html) {
                callback(html);
            }
        });
    }
}