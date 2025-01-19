<div class="categories-list">
    <?foreach ($subcategories as $subcategory):?>
        <a class="category-card" href="/categories/<?="{$category['cat_alias']}/{$subcategory['cat_alias']}";?>">
            <div class="card_cover">
                <img src="/load/categories/<?=$subcategory['cat_image'];?>">
            </div>

            <div class="card_title"><?=$subcategory['cat_title'];?></div>
        </a>
    <?endforeach;?>
</div>
