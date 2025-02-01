class Cart {

    static URL_ACTIONS = '/cart/actions';

    constructor() {}

    init() {
        this.updHtml();
        this.Events();
    }

    Events() {
        let Cart = this;
        $(document).on('click', '.cart [data-action_type], .product-by [data-action_type]', function() {
            if ($(this).data('action_type') == 'show') {
                $('#cart_modal').addClass('show');
                return false;
            }

            let prod_id = typeof($(this).data('prod_id')) !== 'undefined' ? $(this).data('prod_id') : null;
            Cart.runAction($(this).data(), (html) => {
                Cart.updCart(html);
                Cart.updProdButtons(prod_id);
            });
        });

        $(".btn-cart, #cart_modal").hover(function(){}, function(){
            $('#cart_modal').removeClass('show');
        });
        $("body").click(function(){
            $('#cart_modal').removeClass('show');
        });
    }

    updCart(html) {
        let cart_title = '<span>Корзина</span>';
        let count_products = '';

        if (html) {
            let price = $(html).find('.cart-sum').text();
            cart_title = `<span class="cart-sum">${price}</span>`;
            $('#cart_modal').addClass('has-products').find('.modal-body').html(html);
            count_products = $(html).find('.cart-products').data('count_products');
            $('.btn-cart .count-products-icon').html(count_products).removeClass('hidden');
        } else {
            $('#cart_modal').removeClass('has-products').find('.modal-body').html(html);
            $('.btn-cart .count-products-icon').html(count_products).addClass('hidden');
        }

        $('.btn-cart .btn-title').html(cart_title);
    }

    updProdButton($el, has_product) {
        if ($el.parent('.product-by').length > 0) {
            if (has_product) {
                $el.html('В корзине');
                $el.addClass('active');
                $el.data('action_type', 'show');
            } else {
                $el.html('Купить');
                $el.removeClass('active');
                $el.data('action_type', 'append');
            }
        }
    }

    updProdButtons(prod_id) {
        let buttons = prod_id ? $(`.product-by button[data-prod_id="${prod_id}"]`) : $('.product-by button');
        if (buttons.length > 0) {
            let Cart = this;
            buttons.each(function() {
                prod_id = $(this).data('prod_id');
                let prod_exists = $(`#cart_modal .cart-product[data-prod_id="${prod_id}"]`).length;
                Cart.updProdButton($(this), prod_exists);
            });
        }
    }

    updHtml() {
        let Cart = this;
        this.runAction({action_type:'get'}, (html) => {
            Cart.updCart(html);
            Cart.updProdButtons();
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