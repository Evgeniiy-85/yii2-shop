$(function(){
    /* Контекстное меню */
    $(document).on("click", ".context-button", function(){
        var $parent = $(this).parent();

        if( $parent.hasClass('show-dmenu') ){
            $parent.removeClass('show-dmenu');
        } else {
            $(".show-dmenu").removeClass('show-dmenu');
            $parent.addClass('show-dmenu');
        }
    });

    $(document).on("click", function(ev){
        if( $(ev.target).closest('.context-menu').length ) return;
        $(".context-menu").removeClass('show-dmenu');
    });
});
