$(function() {

    var uploadFile = $('#file');
    var uploadURI = 'http://cms.dev/admin/upload/upload';
    var editor = $('.editor');

    $('#image-button').on('click', function() {
        $('#images').slideToggle();
    });

    $('#upload').on('click', function(e) {

        var file_to_upload = uploadFile[0].files[0];
        if (file_to_upload != undefined) {
            // upload file using ajax
            var pickFile = new FormData();
            pickFile.append('userfile', file_to_upload);
            // Ajax Call
            $.ajax({
                url: uploadURI,
                type: 'post',
                data: pickFile,
                processData: false,
                contentType: false,
                success: function(data) {
                    listFiles();
                }
            });
        }

        e.preventDefault();
    });

    function listFiles() {
        str = '<ul class="files">';
        $.getJSON(uploadURI, function(data) {
            $.each(data, function(index, element) {
                str += '<li class="file"><img src="http://cms.dev/assets/img/'+ element +'" width="60" height="40"><span>'+ element +'</span></li>';
            })
            str += '</ul>';
            $('#image-list').html('').html(str);

        });
    }


    $('#images').on('click', 'li.file span', function() {
        src = $(this).prev('img').attr('src');
        $('#img-data').val(src);
    });


    $('#insert').on('click', function() {
       img = $('#img-data').val();
       imgClass = $('#img-class').val();

      editor.val('<img src="'+ img +'" class="'+ imgClass +'">');
    });



});