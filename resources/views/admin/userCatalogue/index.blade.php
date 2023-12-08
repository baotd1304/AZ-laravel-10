@extends('admin.component.layout')

@push('customCSS')
<link rel="stylesheet" href="{{asset('admin/css/plugins/switchery/switchery.css')}}">
@endpush


@section('content')

    <x-admin.breadcrumb title="Quản lý nhóm thành viên"
        name2="Nhóm thành viên"
        name3="Danh sách"
        route1="admin.dashboard"
        route2="admin.userCatalogue.index"
        route3="admin.userCatalogue.index"
        />
    {{-- <div class="wrapper wrapper-content"> --}}
        
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <x-admin.toolbox tableHeading="Danh sách nhóm thành viên" model="UserCatalogue"/>

                        <div class="ibox-content">
                            {{-- Filter wrapper --}}
                            
                            <x-admin.filter-wrapper route="user_catalogue"/>
                            {{-- End filter wrapper --}}
                            {{ $userCatalogues->links('pagination::customize-view')}}

                            <table id="user_table" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="thCheckbox">
                                            <input type="checkbox" id="checkAll" class="checkAll">
                                        </th>
                                        <th>ID</th>
                                        <th>Tên nhóm</th>
                                        <th class="text-center col-lg-2">Số lượng thành viên</th>
                                        <th class="text-center">Hình ảnh</th>
                                        <th class="text-center">Tình trạng</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userCatalogues as $userCatalogue)
                                        <tr>
                                            <td>
                                                <input type="checkbox" value="{{$userCatalogue->id}}" id="checkbox{{$userCatalogue->id}}" class="input-checkbox">
                                            </td>
                                            <td>{{$userCatalogue->id}}</td>
                                            <td>
                                                <div class="user-item">{{$userCatalogue->name}}</div>
                                            </td>
                                            <td class="text-center">
                                                {{count($userCatalogue->users)}}
                                            </td>
                                            <td>
                                                <div class="text-center"><img src="{{$userCatalogue->image}}" alt="" width="50px"></div>
                                            </td>
                                            <td class="text-center js-switch-{{$userCatalogue->id}}">
                                                <input type="checkbox" class="js-switch status" data-field="publish" data-id={{$userCatalogue->id}} data-model="UserCatalogue" value="{{$userCatalogue->publish}}"
                                                {{$userCatalogue->publish==1? 'checked':''}}>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('admin.user_catalogue.edit', $userCatalogue->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <button data-toggle="modal" data-target="#confirmDeleteModal{{$userCatalogue->id}}"
                                                    data-id={{$userCatalogue->id}}
                                                    class="btn btn-danger confirmDelete"><i class="fa fa-trash"></i></button>
                                            </td>
                                            

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            
                            {{ $userCatalogues->links('pagination::customize-view')}}

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
