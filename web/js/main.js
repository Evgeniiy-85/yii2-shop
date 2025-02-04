$(function(){
    let cart = new Cart();
    cart.init();

    let favorites = new Favorites();
    favorites.init();

    $('.image-thumb').click(function() {
        let $container = $(this).closest('.product-images-slider');
        $container.find('.image-thumb').removeClass('active');
        $(this).addClass('active');
        let image_src = $(this).data('img_src');
        $container.find('.images-main img').attr('src', image_src);
    });
});
