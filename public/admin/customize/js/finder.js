(function($){
    "use strict";
    var HT = {};
    
    HT.inputImage = () => {
        $('.input-image').click(function(){
            let fileUpload = $(this).attr('data-upload')
            HT.BrowseServeInput($(this), fileUpload);
        })
    }

    HT.BrowseServeInput = (object, type) => {
        if (typeof(type) == 'undefined'){
            type == 'Images';
        }
        var finder = new CKFinder();
        finder.resourceType = type;

        finder.selectActionFunction = function(fileUrl, data){
            // console.log(fileUrl)    
            // fileUrl = fileUrl.replace(Base_URL, "/");
            
            object.val(fileUrl)
        }
        finder.popup();

    }

    $().ready(function(){
        HT.inputImage();
    });


})(jQuery);