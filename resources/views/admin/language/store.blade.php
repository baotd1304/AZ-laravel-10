@extends('admin.component.layout')

@section('content')
    
    <x-admin.breadcrumb title="{{(isset($language)?'Cập nhật':'Thêm')}} ngôn ngữ"
        name2="Ngôn ngữ"
        name3="{{(isset($language)?'Cập nhật':'Thêm')}} mới"
        route1="{{route('admin.dashboard')}}"
        route2="{{route('admin.languages.index')}}"
        route3="{{(isset($language)? route('admin.languages.edit', $language->id) : route('admin.languages.create'))}}"
    />
    @php
        $url =(isset($language)? route('admin.languages.update', $language->id) : route('admin.languages.store'));
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
                                <input hidden type="text" name="user_id" value="{{Auth()->user()->id??null}}">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Tên ngôn ngữ
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="text" name="name" value="{{old('name', ($language->name)??'')}}" class="form-control @error('name') is-invalid @enderror" autocomplete="off">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Canonical
                                            <span class="text-danger"></span>
                                        </label>
                                        <input type="text" name="canonical" value="{{old('canonical', ($language->canonical)??'')}}" class="form-control @error('canonical') is-invalid @enderror" autocomplete="off">
                                        @error('canonical')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @php
                                $publishs = [
                                    '1' => 'Hiển thị',
                                    '2' => 'Không hiển thị'
                                ];
                            @endphp
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Tình trạng
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <select name="publish"  class="form-control @error('publish') is-invalid @enderror">
                                            @foreach ($publishs as $key => $item)
                                                <option 
                                                    @if(old('publish', ($language->publish)?? '') == $key) selected @endif 
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
                                        <label for="" class="control-label text-left">Hình ảnh
                                        </label>
                                        <input type="text" name="image" 
                                        value="{{old('image', ($language->image)??'')}}" 
                                        class="form-control upload-image" data-type="Images">
                                        <img src="{{asset($language->image??'')}}" alt="" width="100px">
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

    <script src="{{asset('admin/customize/js/finder.js')}}"></script>
    <script src="{{asset('plugins/ckfinder_2/ckfinder.js')}}"></script>

@endpush