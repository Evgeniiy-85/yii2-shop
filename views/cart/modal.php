<?php use yii\helpers\Html;
use app\components\Helpers;
use yii\helpers\Url;?>

<div class="cart">
    <div class="cart-header">
        <div class="cart-title">Список товаров</div>
        <a class="cart-products_remove" href="javascript:void(0);" data-action_type="cart_remove">Очистить список</a>
    </div>

    <div class="cart-body cart-products" data-count_products="<?=$cart->count_products;?>">
        <?foreach($cart->products as $prod_id => $product):
            $quantity = $cart->quantity[$prod_id];?>

            <div class="cart-product" data-prod_id="<?=$product->prod_id;?>">
                <div class="cart-product-cover">
                    <img src="/load/products/<?=$product->prod_image;?>">
                </div>

                <div class="cart-product_info">
                    <div class="cart-product_title"><?=Html::encode($product->prod_title);?></div>
                    <div class="cart-product_price"><?=Helpers::formatPrice($product->prod_price * $quantity);?> ₽</div>
                    <div class="cart-product-quantity_pickers">
                        <a href="javascript:void(0);" class="cart-product-quantity_picker btn_a-primary" data-prod_id="<?=$prod_id;?>" data-action_type="reduce">
                            <i class="fa fa-minus"></i>
                        </a>
                        <div class="cart-product-quantity"><?=$quantity;?></div>
                        <a href="javascript:void(0);" class="cart-product-quantity_picker btn_a-primary" data-prod_id="<?=$prod_id;?>" data-action_type="append">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                    <a href="javascript:void(0);" class="cart-product_remove" data-prod_id="<?=$prod_id;?>"  data-action_type="product_remove">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                            <path d="M12.1663 3.125C12.5115 3.125 12.7913 2.84518 12.7913 2.5C12.7913 2.15482 12.5115 1.875 12.1663 1.875H8.83301C8.48783 1.875 8.20801 2.15482 8.20801 2.5C8.20801 2.84518 8.48783 3.125 8.83301 3.125L12.1663 3.125Z" fill="#AFAFAF"></path>
                            <path d="M17.7913 5C17.7913 5.34518 17.5115 5.625 17.1663 5.625L3.83301 5.625C3.48783 5.625 3.20801 5.34518 3.20801 5C3.20801 4.65482 3.48783 4.375 3.83301 4.375L17.1663 4.375C17.5115 4.375 17.7913 4.65482 17.7913 5Z" fill="#AFAFAF"></path>
                            <path d="M5.49967 7.70833C5.84485 7.70833 6.12467 7.98816 6.12467 8.33333V15.8333C6.12467 16.4086 6.59104 16.875 7.16634 16.875H13.833C14.4083 16.875 14.8747 16.4086 14.8747 15.8333V8.33333C14.8747 7.98816 15.1545 7.70833 15.4997 7.70833C15.8449 7.70833 16.1247 7.98816 16.1247 8.33333V15.8333C16.1247 17.099 15.0987 18.125 13.833 18.125H7.16634C5.90069 18.125 4.87467 17.099 4.87467 15.8333V8.33333C4.87467 7.98816 5.1545 7.70833 5.49967 7.70833Z" fill="#AFAFAF"></path>
                            <path d="M8.83301 9.375C9.17819 9.375 9.45801 9.65482 9.45801 10V14.1667C9.45801 14.5118 9.17819 14.7917 8.83301 14.7917C8.48783 14.7917 8.20801 14.5118 8.20801 14.1667V10C8.20801 9.65482 8.48783 9.375 8.83301 9.375Z" fill="#AFAFAF"></path>
                            <path d="M12.7913 10C12.7913 9.65482 12.5115 9.375 12.1663 9.375C11.8212 9.375 11.5413 9.65482 11.5413 10V14.1667C11.5413 14.5118 11.8212 14.7917 12.1663 14.7917C12.5115 14.7917 12.7913 14.5118 12.7913 14.1667V10Z" fill="#AFAFAF"></path>
                        </svg>
                    </a>
                </div>
            </div><hr>
        <?endforeach;?>
    </div>

    <div class="cart-footer">
        <div class="cart-footer_left">
            <span>Итого: </span>
            <span class="cart-sum"><?=Helpers::formatPrice($cart->total);?> ₽</span>
        </div>

        <div class="cart-footer_right">
            <a href="/cart" class="button button-ui btn_a-outline-primary button-small">
                Оформить заказ
            </a>
        </div>
    </div>
</div>