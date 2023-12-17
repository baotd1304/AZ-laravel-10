(function($){
    "use strict";
    var HT = {};
    
    HT.seoPreview = () => {
        $('input[name=meta_title]').on('input', function(){
            let value = $(this).val()
            $('.meta-title').html(value)
            $('.count-meta_title').text(value.length + ' kí tự')
            if(value.length >= 60){
                $('.count-meta_title').addClass('text-danger')
            } else $('.count-meta_title').removeClass('text-danger')
        })
        $('textarea[name=meta_description]').on('input', function(){
            let value = $(this).val()
            $('.meta-description').html(value)
            $('.count-meta_description').text(value.length + ' kí tự')
            if(value.length >= 160){
                $('.count-meta_description').addClass('text-danger')
            } else $('.count-meta_description').removeClass('text-danger')

        })
        $('input[name=canonical]').css('padding-left', parseInt($('.base-url').outerWidth()) + 10);
        
        $('input[name=canonical]').on('input', function(){
            $('.canonical').html(baseURL + '/' + $(this).val() + suffixURL)
        })
    }

    $().ready(function(){
        HT.seoPreview()
    });


})(jQuery);