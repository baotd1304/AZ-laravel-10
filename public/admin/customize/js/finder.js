(function($){
    "use strict";
    var HT = {};
    
    HT.uploadImageToInput = () => {
        $('.upload-image').click(function(){
            let input = $(this)
            let type = input.attr('data-type')
            HT.setupCkFinder2(input, type);
        })
    }

    HT.setupCkFinder2 = (object, type) => {
        if (typeof(type) == 'undefined'){
            type = 'Images';
        }
        var finder = new CKFinder();
        finder.resourceType = type;
        finder.selectActionFunction = function(fileUrl, data){
            object.val(fileUrl)
            if (object.siblings('input')){ //hien thi img va pass value vao input
                object.find('img').attr('src', fileUrl)
                object.siblings('input').val(fileUrl)
            }
            console.log(fileUrl)
        }
        finder.popup();
    }

    HT.setupCkeditor = () => {
        if ($('.ck-editor')){
            $('.ck-editor').each(function(){
                let editor = $(this)
                let elementId = editor.attr('id')
                HT.ckeditor4(elementId)
            })
        }
    }

    HT.ckeditor4 = (elementId) => {
        CKEDITOR.replace( elementId, {
            language: 'vi',
            height: 200,
        });
    }

    $().ready(function(){
        HT.uploadImageToInput();
        HT.setupCkeditor();
    });


})(jQuery);