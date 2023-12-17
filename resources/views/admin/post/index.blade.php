@extends('admin.component.layout')

@section('content')

    <x-admin.breadcrumb title="Quản lý bài viết"
        name2="Bài viết"
        name3="Danh sách"
        route1="{{route('admin.dashboard')}}"
        route2="{{route('admin.posts.index')}}"
        route3="{{route('admin.posts.index')}}"
        />
    {{-- <div class="wrapper wrapper-content"> --}}
        
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        
                        <x-admin.toolbox tableHeading="Danh sách bài viết" model="Post"/>
                        
                        <div class="ibox-content">
                            {{-- Filter wrapper --}}
                            <x-admin.filter-wrapper :userCatalogues="$postCatalogues" route="posts"/>
                            {{-- End filter wrapper --}}
                            {{ $posts->links('pagination::customize-view')}}

                            <table id="user_table" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="thCheckbox">
                                            <input type="checkbox" id="checkAll" class="checkAll">
                                        </th>
                                        <th>ID</th>
                                        <th>Họ tên</th>
                                        <th class="text-center">Hình ảnh</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th class="text-center">Nhóm bài viết</th>
                                        <th class="text-center">Tình trạng</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>
                                                <input type="checkbox" value="{{$post->id}}" id="checkbox{{$post->id}}" class="input-checkbox">
                                            </td>
                                            <td>{{$post->id}}</td>
                                            <td>
                                                <div class="user-item">{{$post->name}}</div>
                                            </td>
                                            <td>
                                                <div class="text-center"><img src="{{$post->image}}" alt="" width="50px"></div>
                                            </td>
                                            <td>{{$post->email}}</td>
                                            <td>{{$post->phone}}</td>
                                            <td class="text-center col-lg-2">
                                                <select name="post_catalogue_id" class="form-control fieldSelect" data-id={{$post->id}} data-model="Post" data-field="post_catalogue_id">
                                                    @foreach ($postCatalogues as $postCatalogue)
                                                        <option {{$post->post_catalogue_id == $postCatalogue->id ? 'selected' : ''}}
                                                            value="{{$postCatalogue->id}}">{{$postCatalogue->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="text-center js-switch-{{$post->id}}">
                                                <input type="checkbox" class="js-switch status" data-field="publish" data-id={{$post->id}} data-model="Post" value="{{$post->publish}}"
                                                {{$post->publish==1? 'checked':''}}>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <button data-toggle="modal" data-target="#confirmDeleteModal{{$post->id}}"
                                                    data-id={{$post->id}}
                                                    class="btn btn-danger confirmDelete"><i class="fa fa-trash"></i></button>
                                            </td>
                                            

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            
                            {{ $posts->links('pagination::customize-view')}}

                        </div>
                    </div>
                </div>
            </div>
    
            
            
        </div>
    {{-- </div> --}}
    
@endsection

@push('customCSS')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">

@endpush

@push('customJS')
    <script src="{{asset('admin/js/plugins/switchery/switchery.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endpush
