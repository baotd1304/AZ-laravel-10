(function($){
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');
    
    HT.switchery = () => {
        $('.js-switch').each(function(){
            var switchery = new Switchery(this, { color: '#1AB394', size: 'small' });
        })
    }

    HT.select2 = () => {
        $('.setupSelect2').select2();
    }

    

    //confirm delete model
    HT.confirmDelete = () => {
        $('.confirmDelete').click(function() {
            let option = {
                'id' : $(this).data('id'),
                'url': $(this).data('id'),
                '_token' : _token
            }
            sweetConfirm(option);
        })
    }

    //Delete all checked box
    HT.deleteChecked = () => {
        $('.deleteChecked').click(function() {
            let _this = $(this)
            let id = []
            $('.input-checkbox').each(function(){
                if ($(this).prop('checked')){
                    id.push($(this).val())
                }
            })
            let option = {
                'value' : _this.attr('data-value'),
                'model' : _this.attr('data-model'),
                'field' : _this.attr('data-field'),
                'id' : id,
                'url': '/delete-checked',
                '_token' : _token,
            }
            sweetConfirm(option);
        })
    }

    function sweetConfirm(option){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-danger",
              cancelButton: "btn btn-success mr10"
            },
            buttonsStyling: false
          });
          swalWithBootstrapButtons.fire({
            title: "Bạn chắc chắn muốn xóa dữ liệu của "+option.id.length+ " bản ghi hay không?",
            text: "Mã ID: "+option.id,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "XÓA",
            cancelButtonText: "HỦY",
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                // Gửi yêu cầu xóa khi người dùng xác nhận
                $.ajax({
                    type: 'DELETE',
                    url:  option.url,
                    data: option,
                    dataType: 'json',
                    success: function(response) {
                        // Hiển thị thông báo xóa thành công
                        swalWithBootstrapButtons.fire({
                            title: 'Thành công!',
                            text: response.message,
                            icon: 'success'
                        });
                        // load lai trang
                        location.reload();
                    },
                    error: function(error) {
                        // Hiển thị thông báo lỗi
                        swalWithBootstrapButtons.fire({
                            title: 'Lỗi!',
                            text: 'Đã xảy ra lỗi khi xóa.',
                            icon: 'error'
                        });
                    }
                });
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
                ) {
                swalWithBootstrapButtons.fire({
                    title: "Đã hủy!",
                    text: "Dữ liệu chưa bị xóa",
                    icon: "error"
                });
            }
        });
    }

    
    //check all checkbox
    HT.checkAll = () => {
        $('#checkAll').change(function(){
            if ($(this).prop("checked")) {
                $('.input-checkbox').prop('checked', true)
            } else {
                $('.input-checkbox').prop('checked', false)
            }
            HT.updateBackgroundColor();
        })
        $(".input-checkbox").change(function() {
            // Kiểm tra xem tất cả các checkbox có được chọn không để cập nhật trạng thái của "Check All"
            if ($(".input-checkbox:checked").length === $(".input-checkbox").length) {
                $(".checkAll").prop("checked", true);
            } else {
                $(".checkAll").prop("checked", false);
            }
            HT.updateBackgroundColor();
        });
    }
    HT.updateBackgroundColor = () => {
        $('.input-checkbox').each(function(){
            if ($(this).prop('checked')){
                $(this).closest('tr').addClass('checked-bg');
            } else {
                $(this).closest('tr').removeClass('checked-bg');
            }
        })
    }

    //change status input checkbox
    HT.changeStatus = () => {
        $('.status').change(function(){
            let _this =  $(this);
            let option = {
                'value' : _this.val(),
                'id' : _this.attr('data-id'),
                'model' : _this.attr('data-model'),
                'field' : _this.attr('data-field'),
                '_token' : _token
            }
            $.ajax({
                url: '/change-status',
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function(res){
                    console.log(res);
                    // Hiển thị SweetAlert2 Mixin
                    sweetSuccessMixin(res)
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                    sweetErrorMixin()
                }
            })
        })
    }
    function sweetSuccessMixin (res){
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "Thành công",
            text: res.message,
        });
    }
    function sweetErrorMixin (){
        Toast.fire({
            title: 'Lỗi!',
            text: 'Đã xảy ra lỗi.',
            icon: 'error',
        });
    }
    
    //change status all checkbox
    HT.changeStatusAll = () => {
        $('.changeStatusAll').on('click', function(){
            let _this = $(this)
            let id = []
            $('.input-checkbox').each(function(){
                if ($(this).prop('checked')){
                    id.push($(this).val())
                }
            })
            let option = {
                'value' : _this.attr('data-value'),
                'model' : _this.attr('data-model'),
                'field' : _this.attr('data-field'),
                'id' : id,
                '_token' : _token,
            }
            $.ajax({
                url: '/change-status-all',
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function(res){
                    console.log(res);
                    if (res.result && option.value == 1){
                        let spanActive = 'background-color: rgb(26, 179, 148); border-color: rgb(26, 179, 148); box-shadow: rgb(26, 179, 148) 0px 0px 0px 11px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;'
                        let smallActive = 'left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;'
                        for(let i=0; i < id.length; i++){
                            $('.js-switch-'+id[i]).find('span.switchery').attr('style', spanActive).find('small').attr('style', smallActive);
                        }
                    }
                    if (res.result && option.value != 1){
                        let spanUnactive = 'box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;'
                        let smallUnactive = 'left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;'
                        for(let i=0; i < id.length; i++){
                            $('.js-switch-'+id[i]).find('span.switchery').attr('style', spanUnactive).find('small').attr('style', smallUnactive);
                        }
                    }
                    // Hiển thị SweetAlert2 Mixin
                    sweetSuccessMixin(res)
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                    sweetErrorMixin()
                }
            })
        })
    }
    



    $().ready(function(){
        HT.switchery();
        HT.select2();
        HT.confirmDelete();
        HT.checkAll();
        HT.changeStatus();
        HT.changeStatusAll();
        HT.deleteChecked();
    });

    
})(jQuery);