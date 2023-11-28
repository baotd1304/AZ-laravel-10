@extends('admin.component.layout')

@section('content')
    <x-admin.breadcrumb title="Thêm thành viên mới"
        name2="Thành viên"
        name3="Thêm thành viên"
        route1="admin.dashboard"
        route2="admin.user.index"
        route3="admin.user.create"
    />

    <form action="" method="" class="box">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel-head">
                        <div class="panel-title">Thông tin chung</div>
                        <div class="panel-description">
                            <p>Nhập thông tin chung của người sử dụng</p>
                            <p>Lưu ý những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Email
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="text" name="email" value="" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Họ và tên
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="text" name="name" value="" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Nhóm thành viên
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <select name="user_catalogue_id" id="" class="form-control">
                                            <option value="0">[Chọn nhóm thành viên]</option>
                                            <option value="1">Quản trị viên</option>
                                            <option value="2">Cộng tác viên</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Ngày sinh
                                            <span class="text-danger"></span>
                                        </label>
                                        <input type="text" name="birthday" value="" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Mật khẩu
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="password" name="password" value="" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Xác nhận mật khẩu
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="password" name="confirm_password" value="" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Ảnh dại diện
                                        </label>
                                        <input type="file" name="image" value="" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel-head">
                        <div class="panel-title">Thông tin liên hệ</div>
                        <div class="panel-description">
                            <div class="panel-description">
                                <p>Nhập thông tin liên hệ của người sử dụng</p>
                                <p>Lưu ý những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Địa chỉ
                                            <span class="text-danger"></span>
                                        </label>
                                        <input type="text" name="address" value="" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Phường/Xã
                                        </label>
                                        <select name="ward_id" class="form-control" id="">
                                            <option value="0">[Chọn phường/xã]</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Quận/Huyện
                                        </label>
                                        <select name="district_id" class="form-control" id="">
                                            <option value="0">[Chọn quận/huyện]</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Thành phố
                                        </label>
                                        <select name="province_id" class="form-control" id="">
                                            <option value="0">[Chọn thành phố]</option>
                                        </select>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Số điện thoại
                                        </label>
                                        <input type="text" name="phone" value="" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Ghi chú
                                        </label>
                                        <input type="text" name="description" value="" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right mb15">
                <button type="submit" name="send" value="send" class="btn btn-lg btn-primary">Lưu</button>
            </div>
        </div>
    </form>

@endsection
