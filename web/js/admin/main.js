$(function(){
    /* Контекстное меню */
    $(document).on("click", ".context-button", function(){
        let $parent = $(this).parent();

        if( $parent.hasClass('show-dmenu') ){
            $parent.removeClass('show-dmenu');
        } else {
            $(".show-dmenu").removeClass('show-dmenu');
            $parent.addClass('show-dmenu');
        }
    });

    $(document).on("click", function(ev){
        if ($(ev.target).closest('.context-menu').length) {
            return;
        }
        $(".context-menu").removeClass('show-dmenu');
    });

    $('input[type="file"]:not([multiple])').closest('label').each(function(){
        let $input_file = $(this).find('[type="file"]'),
        $label = $(this).css({'overflow':'hidden'});
        $label.data('placeholder', $label.find('text').html());

        $input_file.on('change', function(){
            if( $(this).val() ){
                $label.find('text').html('<i class="fa fa-file-o"></i>&nbsp; ' + $(this).val().replace(/.*?([^\/|\\]+)$/, '$1'));
            } else {
                $label.find('text').html($label.data('placeholder'));
            }
        })
    });

    /* Сustom-file */
    $(".custom-file-label").each(function(){
        let $label = $(this); console.log($label);
        let $input_file = $(this).closest('.custom-file').children('[type="file"]');
        $input_file.on('change', function(){
            $label.html($input_file.val().replace(/.*?([^\/|\\]+)$/, '$1'));
        });
        $input_file.on('click touchstart' , function(){
            //$label.html('');
        });
    });
});
