<div class="products-list">
    <?foreach ($products as $product):?>
        <div class="product-card">
            <div class="product_cover">
                <img src="/load/products/<?=$product['prod_image'];?>">
            </div>

            <a class="card_title" href="/products/<?=$product['prod_alias'];?>"><?=$product['prod_title'];?></a>
        </div>
    <?endforeach;?>
</div>
