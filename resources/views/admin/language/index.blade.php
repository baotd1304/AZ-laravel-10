@extends('admin.component.layout')

@section('content')

    <x-admin.breadcrumb title="Quản lý ngôn ngữ"
        name2="Ngôn ngữ"
        name3="Danh sách"
        route1="{{route('admin.dashboard')}}"
        route2="{{route('admin.languages.index')}}"
        route3="{{route('admin.languages.index')}}"
        />
    {{-- <div class="wrapper wrapper-content"> --}}
        
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <x-admin.toolbox tableHeading="Danh sách ngôn ngữ" model="Language"/>

                        <div class="ibox-content">
                            {{-- Filter wrapper --}}
                            
                            <x-admin.filter-wrapper route="languages"/>
                            {{-- End filter wrapper --}}
                            {{ $languages->links('pagination::customize-view')}}

                            <table id="user_table" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="thCheckbox">
                                            <input type="checkbox" id="checkAll" class="checkAll">
                                        </th>
                                        <th>ID</th>
                                        <th>Tên ngôn ngữ</th>
                                        <th>Canonical</th>
                                        <th class="text-center col-lg-2">Số lượng nhóm bài viết</th>
                                        <th class="text-center col-lg-2">Số lượng bài viết</th>
                                        <th class="text-center">Hình ảnh</th>
                                        <th class="text-center">Tình trạng</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($languages as $language)
                                        <tr>
                                            <td>
                                                <input type="checkbox" value="{{$language->id}}" id="checkbox{{$language->id}}" class="input-checkbox">
                                            </td>
                                            <td>{{$language->id}}</td>
                                            <td>
                                                <div class="user-item">{{$language->name}}</div>
                                            </td>
                                            <td class="text-center">
                                                {{$language->canonical}}
                                            </td>
                                            <td class="text-center">
                                                {{count($language->postCatalogues)}}
                                            </td>
                                            <td class="text-center">
                                                {{count($language->posts)}}
                                            </td>
                                            <td>
                                                <div class="text-center"><img src="{{$language->image}}" alt="" width="50px"></div>
                                            </td>
                                            <td class="text-center js-switch-{{$language->id}}">
                                                <input type="checkbox" class="js-switch status" data-field="publish" data-id={{$language->id}} data-model="Language" value="{{$language->publish}}"
                                                {{$language->publish==1? 'checked':''}}>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('admin.languages.edit', $language->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <button data-toggle="modal" data-target="#confirmDeleteModal{{$language->id}}"
                                                    data-id={{$language->id}}
                                                    class="btn btn-danger confirmDelete"><i class="fa fa-trash"></i></button>
                                            </td>
                                            

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            
                            {{ $languages->links('pagination::customize-view')}}

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
