@extends('admin.component.layout')

@section('content')

    <x-admin.breadcrumb title="Quản lý nhóm bài viết"
        name2="Nhóm bài viết"
        name3="Danh sách"
        route1="{{route('admin.dashboard')}}"
        route2="{{route('admin.post_catalogues.index')}}"
        route3="{{route('admin.post_catalogues.index')}}"
        />
    {{-- <div class="wrapper wrapper-content"> --}}
        
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <x-admin.toolbox tableHeading="Danh sách nhóm bài viết" model="PostCatalogue"/>

                        <div class="ibox-content">
                            {{-- Filter wrapper --}}
                            
                            <x-admin.filter-wrapper route="post_catalogues"/>
                            {{-- End filter wrapper --}}
                            {{ $postCatalogues->links('pagination::customize-view')}}

                            <table id="user_table" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="thCheckbox">
                                            <input type="checkbox" id="checkAll" class="checkAll">
                                        </th>
                                        <th>ID</th>
                                        <th>Tên nhóm</th>
                                        <th class="text-center col-lg-2">Số lượng bài viết</th>
                                        <th class="text-center">Hình ảnh</th>
                                        <th class="text-center">Người tạo</th>
                                        <th class="text-center">Tình trạng</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($postCatalogues as $postCatalogue)
                                        <tr>
                                            <td>
                                                <input type="checkbox" value="{{$postCatalogue->id}}" id="checkbox{{$postCatalogue->id}}" class="input-checkbox">
                                            </td>
                                            <td>{{$postCatalogue->id}}</td>
                                            <td>
                                                @foreach ($postCatalogue->languages as $lang1)
                                                    <div>{{$lang1->pivot->name}}</div>
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                {{count($postCatalogue->posts)}}
                                            </td>
                                            <td>
                                                <img src="{{$postCatalogue->image}}" alt="" width="50px">
                                            </td>
                                            {{-- @dd($postCatalogue) --}}
                                            <td class="text-center">{{$postCatalogue->author->name}}</td>
                                            <td class="text-center js-switch-{{$postCatalogue->id}}">
                                                <input type="checkbox" class="js-switch status" data-field="publish" data-id={{$postCatalogue->id}} data-model="PostCatalogue" value="{{$postCatalogue->publish}}"
                                                {{$postCatalogue->publish==1? 'checked':''}}>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('admin.post_catalogues.edit', $postCatalogue->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <button data-toggle="modal" data-target="#confirmDeleteModal{{$postCatalogue->id}}"
                                                    data-id={{$postCatalogue->id}}
                                                    class="btn btn-danger confirmDelete"><i class="fa fa-trash"></i></button>
                                            </td>
                                            

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            
                            {{ $postCatalogues->links('pagination::customize-view')}}

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
