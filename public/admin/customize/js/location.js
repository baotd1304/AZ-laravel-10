(function($){
    "use strict";
    var HT = {};
    
    HT.getLocation = () => {
        $('.location').change(function(){
            let _this = $(this)
            let option = {
                'data' : {
                    'location_id' : _this.val(),
                },
                'target' : _this.attr('data-target')
            }
            HT.sendDataToGetLocation(option);
        })
    }

    HT.sendDataToGetLocation = (option) => {
            $.ajax({
                url: '/get-location',
                type: 'GET',
                data: option,
                dataType: 'json',
                success: function(res){
                    $('.'+option.target).html(res.html)

                    //get location when reload page
                    if (district_id != '' && option.target == 'districts'){
                        $('.districts').val(district_id).trigger('change')
                    }
                    if (ward_id != '' && option.target == 'wards'){
                        $('.wards').val(ward_id).trigger('change')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                }
            })
    }

    HT.getLocationWhenReloadPage = () => {
        if(province_id != ''){
            $('.provinces').val(province_id).trigger('change');
        }
    }

    $().ready(function(){
        HT.getLocation();
        HT.getLocationWhenReloadPage();
    });


})(jQuery);