$(function(){
    $(document).on("change", 'input[type="file"][multiple]', function(){
        download_files(this);
    });

    $(document).on("click", '.attach-delete', function(){
        delete_file(this);
    });

    function download_files(input) {
        let formData = new FormData;
        let $container = $(input).closest('label').next('.attachments');
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

    function delete_file(input) {
        let $container = $(input).closest('.attach-wrap');
        let file = $container.find('input[type="hidden"]').val();
        $container.remove();
    };
});