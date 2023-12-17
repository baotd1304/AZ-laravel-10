@extends('admin.component.layout')

@section('content')
    
    <x-admin.breadcrumb title="{{(isset($postCatalogue)?'Cập nhật':'Thêm')}} nhóm bài viết"
        name2="Nhóm bài viết"
        name3="{{(isset($postCatalogue)?'Cập nhật':'Thêm')}} mới"
        route1="{{route('admin.dashboard')}}"
        route2="{{route('admin.post_catalogues.index')}}"
        route3="{{(isset($postCatalogue)? route('admin.post_catalogues.edit', $postCatalogue->id) : route('admin.post_catalogues.create'))}}"
    />
    @php
        $url =(isset($postCatalogue)? route('admin.post_catalogues.update', $postCatalogue->id) : route('admin.post_catalogues.store'));
    @endphp
    <form action="{{$url}}" method="post" class="box">
        @csrf
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-9">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Thông tin chung</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row mb15">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Tên nhóm bài viết
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <input type="text" name="name" value="{{old('name', ($postCatalogue->name)??'')}}" class="form-control @error('name') is-invalid @enderror" autocomplete="off">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Mô tả ngắn
                                            <span class="text-danger"></span>
                                        </label>
                                        <textarea id="description" name="description" class="form-control ck-editor @error('description') is-invalid @enderror" autocomplete="off">{{old('description', ($postCatalogue->description)??'')}}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb15">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Nội dung
                                            <span class="text-danger"></span>
                                        </label>
                                        <textarea id="content" name="content" class="form-control ck-editor @error('content') is-invalid @enderror" autocomplete="off">{{old('content', ($postCatalogue->content)??'')}}</textarea>
                                        @error('content')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Cấu hình SEO</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="seo-container">
                                <div class="meta-title">
                                    Tiêu đề SEO
                                </div>
                                <div class="canonical">
                                    {{$baseURL.'/duong-dan-seo'.$suffixURL}}
                                </div>
                                <div class="meta-description">
                                    Mô tả SEO
                                </div>
                            </div>
                            <div class="seo-wrapper mt15">
                                <div class="row mt15">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">
                                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                    <span>Tiêu đề SEO</span>
                                                    <span class="count-meta_title">0 ký tự</span>
                                                </div>
                                            </label>
                                            <input type="text" name="meta_title" value="{{old('meta_title', ($postCatalogue->meta_title)??'')}}" class="form-control @error('meta_title') is-invalid @enderror" autocomplete="off">
                                            @error('meta_title')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt15">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">
                                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                    <span>Từ khóa SEO</span>
                                                </div>
                                            </label>
                                            <input type="text" name="meta_keyword" value="{{old('meta_keyword', ($postCatalogue->meta_keyword)??'')}}" class="form-control @error('meta_keyword') is-invalid @enderror" autocomplete="off">
                                            @error('meta_keyword')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt15">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">
                                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                    <span>Mô tả SEO</span>
                                                    <span class="count-meta_description">0 ký tự</span>
                                                </div>
                                            </label>
                                            <textarea name="meta_description" rows="3" class="form-control @error('meta_description') is-invalid @enderror" autocomplete="off">{{old('meta_description', ($postCatalogue->meta_description)??'')}}</textarea>
                                            @error('meta_description')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt15">
                                    <div class="col-lg-12">
                                        <div class="form-row">
                                            <label for="" class="control-label text-left">
                                                <span>Đường dẫn</span>
                                            </label>
                                            <div class="input-wrapper">
                                                <input type="text" name="canonical" value="{{old('canonical', ($postCatalogue->canonical)??'')}}" class="form-control @error('canonical') is-invalid @enderror">
                                                <span class="base-url">
                                                    {{$baseURL.'/'}}
                                                </span>
                                                @error('canonical')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Chọn danh mục cha
                                            <span class="text-danger">(*)</span>
                                        </label>
                                        <span class="text-danger notice">Để trống nếu không có danh mục cha</span>
                                        <select name="parentId" class="form-control setupSelect2 @error('parentId') is-invalid @enderror">
                                                <option value="0">Chọn danh mục</option>
                                            @foreach ($postCatalogues as $value => $item )
                                                <option {{(old('parentId', ($postCatalogue->parentId)?? '') == $value)? 'selected':'' }} value="{{$value}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                        @error('parentId')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            Tùy chọn nâng cao
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <select name="publish" class="form-control setupSelect2 @error('publish') is-invalid @enderror">
                                                <option value="0">Chọn tình trạng hoạt động</option>
                                            @foreach ($publishs as $value => $item )
                                                <option {{(old('publish', ($postCatalogue->publish)?? '') == $value)? 'selected':'' }} value="{{$value}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                        @error('publish')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-row mt15">
                                        <select name="follow" class="form-control setupSelect2 @error('follow') is-invalid @enderror">
                                                <option value="0">Chọn tình trạng theo dõi</option>
                                            @foreach ($follows as $value => $item )
                                                <option {{(old('follow', ($postCatalogue->follow)?? '') == $value)? 'selected':'' }} value="{{$value}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                        @error('follow')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            Chọn ảnh đại diện
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-row">
                                        <span class="image img-cover upload-image" data-type="Images">
                                            <img src="{{(old('image') == '' && ($postCatalogue->image??'') == '')? 
                                            asset('img/no-image-icon-0.jpg'): old('image'), (($postCatalogue->image)?? '')}}" alt="" width="100%">
                                        </span>
                                        <input hidden name="image" value="{{old('image'), (($postCatalogue->image)?? '')}}">
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
    <script src="{{asset('admin/customize/js/SEO.js')}}"></script>
    <script src="{{asset('plugins/ckfinder_2/ckfinder.js')}}"></script>
    
    <script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        var baseURL = '{{$baseURL}}';
        var suffixURL = '{{$suffixURL}}';
    </script>


        

@endpush