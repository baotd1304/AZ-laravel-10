(function($){
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');
    
    HT.switchery = () => {
        $('.js-switch').each(function(){
            var switchery = new Switchery(this, { color: '#1AB394' });
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
                '_token' : _token
            }
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: "btn btn-danger",
                  cancelButton: "btn btn-success mr10"
                },
                buttonsStyling: false
              });
              swalWithBootstrapButtons.fire({
                title: "Bạn chắc chắn muốn xóa dữ liệu - Mã ID: "+option.id+ "?",
                // text: "You won't be able to revert this!",
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
                        url:  option.id,
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
        })
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
                    console.log(option)
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                    Toast.fire({
                        title: 'Lỗi!',
                        text: 'Đã xảy ra lỗi.',
                        icon: 'error',
                    });
                }
            })
        })
    }
    
    //change status all checkbox
    HT.changeStatusAll = () => {
        if ($('.changeStatusAll').length());
    }

    



    $().ready(function(){
        HT.switchery();
        HT.select2();
        HT.changeStatus();
        HT.confirmDelete();
        HT.checkAll();
    });

    
})(jQuery);