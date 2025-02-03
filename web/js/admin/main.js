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

    $("label.input-file").each(function(){
        var $input_file = $(this).find('[type="file"]'),
            $label = $(this).css({'overflow':'hidden'});
        $label.data('placeholder', $label.find('text').html());
        $input_file.on('change', function(){
            if( $(this).val() ){
                $label.find('text')
                    .html( '<i class="fa fa-file-o"></i>&nbsp; ' + $(this).val().replace(/.*?([^\/|\\]+)$/, '$1') );
            } else {
                $label.find('text').html( $label.data('placeholder') );
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


    $(document).on("change", 'input[type="file"][multiple]', function(){
        download_files(this);
    });

    function download_files(input) {
        let formData = new FormData;
        let $container = $(input).closest('div').next('.attachments');
        let dir = $container.data('dir');

        for (let file in $(input)[0].files) {
            formData.append($(input).attr('name'),  $(input)[0].files[file]);
        }
        formData.append('dir',  dir);

        $.ajax({
            url: '/admin/attachments/add',
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(html){
                if (html) {
                    $container.append(html);
                }
            }, error: function(err){
                console.error(err);
            }
        });
    };
});
