@extends('admin.component.layout')

@section('content')
    
    <x-admin.breadcrumb title="{{(isset($userCatalogue)?'Cập nhật':'Thêm')}} nhóm thành viên"
        name2="Nhóm thành viên"
        name3="{{(isset($userCatalogue)?'Cập nhật':'Thêm')}} mới"
        route1="{{route('admin.dashboard')}}"
        route2="{{route('admin.user_catalogues.index')}}"
        route3="{{(isset($userCatalogue)? route('admin.user_catalogues.edit', $userCatalogue->id) : route('admin.user_catalogues.create'))}}"
    />
    @php
        $url =(isset($userCatalogue)? route('admin.user_catalogues.update', $userCatalogue->id) : route('admin.user_catalogues.store'));
    @endphp
    <form action="{{$url}}" method="post" class="box">
        @csrf
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
                                        <label for="" class="control-label text-left">Tên nhóm
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="text" name="name" value="{{old('name', ($userCatalogue->name)??'')}}" class="form-control @error('name') is-invalid @enderror" autocomplete="off">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Ghi chú
                                            <span class="text-danger"></span>
                                        </label>
                                        <input type="text" name="description" value="{{old('description', ($userCatalogue->description)??'')}}" class="form-control @error('description') is-invalid @enderror" autocomplete="off">
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Tình trạng
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <select name="publish"  class="form-control @error('publish') is-invalid @enderror">
                                            @foreach ($publishs as $key => $item)
                                                <option 
                                                    @if(old('publish', ($userCatalogue->publish)?? '') == $key) selected @endif 
                                                    value="{{$key}}">
                                                    {{$item}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('publish')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Ảnh dại diện
                                        </label>
                                        <input type="text" name="image" 
                                        value="{{old('image', ($userCatalogue->image)??'')}}" 
                                        class="form-control upload-image" data-type="Images" autocomplete="off">
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

@endpush