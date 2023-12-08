@extends('admin.component.layout')

@push('customCSS')
<link rel="stylesheet" href="{{asset('admin/css/plugins/switchery/switchery.css')}}">
@endpush


@section('content')

    <x-admin.breadcrumb title="Quản lý thành viên"
        name2="Thành viên"
        name3="Danh sách"
        route1="admin.dashboard"
        route2="admin.user.index"
        route3="admin.user.index"
        />
    {{-- <div class="wrapper wrapper-content"> --}}
        
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        
                        <x-admin.toolbox tableHeading="Danh sách thành viên" model="User"/>
                        
                        <div class="ibox-content">
                            {{-- Filter wrapper --}}
                            <x-admin.filter-wrapper :userCatalogues="$userCatalogues" route="user"/>
                            {{-- End filter wrapper --}}
                            {{ $users->links('pagination::customize-view')}}

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
                                        <th class="text-center">Nhóm thành viên</th>
                                        <th class="text-center">Tình trạng</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <input type="checkbox" value="{{$user->id}}" id="checkbox{{$user->id}}" class="input-checkbox">
                                            </td>
                                            <td>{{$user->id}}</td>
                                            <td>
                                                <div class="user-item">{{$user->name}}</div>
                                            </td>
                                            <td>
                                                <div class="text-center"><img src="{{$user->image}}" alt="" width="50px"></div>
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td class="text-center col-lg-2">
                                                <select name="user_catalogue_id" class="form-control fieldSelect" data-id={{$user->id}} data-model="User" data-field="user_catalogue_id">
                                                    @foreach ($userCatalogues as $userCatalogue)
                                                        <option {{$user->user_catalogue_id == $userCatalogue->id ? 'selected' : ''}}
                                                            value="{{$userCatalogue->id}}">{{$userCatalogue->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="text-center js-switch-{{$user->id}}">
                                                <input type="checkbox" class="js-switch status" data-field="publish" data-id={{$user->id}} data-model="User" value="{{$user->publish}}"
                                                {{$user->publish==1? 'checked':''}}>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <button data-toggle="modal" data-target="#confirmDeleteModal{{$user->id}}"
                                                    data-id={{$user->id}}
                                                    class="btn btn-danger confirmDelete"><i class="fa fa-trash"></i></button>
                                            </td>
                                            

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            
                            {{ $users->links('pagination::customize-view')}}

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
