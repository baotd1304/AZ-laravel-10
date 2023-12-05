@extends('admin.component.layout')

@section('content')
    
    <x-admin.breadcrumb title="{{(isset($user)?'Cập nhật':'Thêm')}} thành viên"
        name2="Thành viên"
        name3="{{(isset($user)?'Cập nhật':'Thêm')}} thành viên"
        route1="{{route('admin.dashboard')}}"
        route2="{{route('admin.user.index')}}"
        route3="{{(isset($user)? route('admin.user.edit', $user->id) : route('admin.user.create'))}}"
    />
    @php
        $url =(isset($user)? route('admin.user.update', $user->id) : route('admin.user.store'));
    @endphp
    <form action="{{$url}}" method="post" class="box">
        @csrf
        @if (isset($user))
            {{-- @method('PUT') --}}
        @endif
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
                                        <input type="text" name="email" value="{{old('email', ($user->email)??'')}}" class="form-control @error('email') is-invalid @enderror" autocomplete="off">
                                        @error('email')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Họ và tên
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="text" name="name" value="{{old('name', ($user->name)??'')}}" class="form-control @error('name') is-invalid @enderror" autocomplete="off">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @php
                                $userCatalogue = [
                                    '[Chọn nhóm thành viên]',
                                    'Quản trị viên',
                                    'Cộng tác viên'
                                ];
                            @endphp
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Nhóm thành viên
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <select name="user_catalogue_id"  class="form-control @error('user_catalogue_id') is-invalid @enderror">
                                            @foreach ($userCatalogue as $key => $item)
                                                <option 
                                                    @if(old('user_catalogue_id', ($user->user_catalogue_id)?? '') == $key) selected @endif 
                                                    value="{{$key}}">
                                                    {{$item}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_catalogue_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Ngày sinh
                                            <span class="text-danger"></span>
                                        </label>
                                        <input type="date" name="birthday"
                                        value="{{old('birthday', (isset($user->birthday)? date('Y-m-d', strtotime($user->birthday)) : ''))}}"
                                        class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            @if (!isset($user))
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Mật khẩu
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="password" name="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" autocomplete="off">
                                        @error('password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Xác nhận mật khẩu
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="password" name="confirm_password" value="{{old('confirm_password')}}" class="form-control @error('confirm_password') is-invalid @enderror" autocomplete="off">
                                        @error('confirm_password')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @endif
                             
                            <div class="row mb15">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Ảnh dại diện
                                        </label>
                                        {{-- <input type="text" name="image" 
                                        value="{{old('image', ($user->image)??'')}}" 
                                        class="form-control input-image" data-upload="Images" autocomplete="off"> --}}
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
                                        <label for="" class="control-label text-left">Thành phố
                                        </label>
                                        <select name="province_id" class="form-control setupSelect2 provinces location" data-target="districts" >
                                            <option value="0">[Chọn tỉnh/thành phố]</option>
                                            @foreach ($provinces as $province)
                                                <option 
                                                    @if (old('province_id', ($user->province_id)?? '') == $key) selected @endif
                                                    value="{{$province->code}}">{{$province->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Quận/Huyện
                                        </label>
                                        <select name="district_id" class="form-control setupSelect2 districts location" data-target="wards" >
                                            <option value="0">[Chọn quận/huyện]</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Phường/Xã
                                        </label>
                                        <select name="ward_id" class="form-control setupSelect2 wards" >
                                            <option value="0">[Chọn phường/xã]</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Địa chỉ
                                            <span class="text-danger"></span>
                                        </label>
                                        <input type="text" name="address" value="{{old('address', ($user->address)??'')}}" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Số điện thoại
                                        </label>
                                        <input type="number" name="phone" value="{{old('phone', ($user->phone)??'')}}" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Ghi chú
                                        </label>
                                        <input type="text" name="description" value="{{old('description', ($user->description)??'')}}" class="form-control" autocomplete="off">
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


@push('customCSS')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush

@push('customJS')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{asset('admin/customize/js/location.js')}}"></script>
<script src="{{asset('admin/customize/js/finder.js')}}"></script>
<script src="{{asset('plugins/ckfinder_2/ckfinder.js')}}"></script>

<script>
    var province_id ='{{ (isset($user->province_id))? $user->province_id : old('province_id') }}'
    var district_id ='{{ (isset($user->district_id))? $user->district_id : old('district_id') }}'
    var ward_id ='{{ (isset($user->ward_id))? $user->ward_id : old('ward_id') }}'

</script>


@endpush