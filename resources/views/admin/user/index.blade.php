@extends('admin.component.layout')

@push('customCSS')
<link rel="stylesheet" href="{{asset('admin/css/plugins/switchery/switchery.css')}}">
@endpush


@section('content')

    <x-admin.breadcrumb title="Quản lý thành viên"
        name2="Thành viên"
        name3="Danh sách thành viên"
        route1="admin.dashboard"
        route2="admin.user.index"
        route3="admin.user.index"
        />
    {{-- <div class="wrapper wrapper-content"> --}}
        
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        
                        <div class="ibox-title">
                            <h5>{{ config('apps.user.tableHeading') }}</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#" id="changeStatusAll" class="changeStatusAll" data-model="User" data-value="1" data-field="publish">Publish đã chọn</a>
                                    </li>
                                    <li><a href="#" class="changeStatusAll" data-model="User" data-value="2" data-field="publish">Unpublish đã chọn</a>
                                    </li>
                                    <li><a href="#" class="deleteChecked" data-model="User" data-value="delete" data-field="deleted_at">Xóa đã chọn</a>
                                    </li>

                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            {{-- Filter wrapper --}}
                            <form action="{{route('admin.user.index')}}">
                                <div class="filter-wrapper">
                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                        <div class="perPage">
                                            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                <select name="per_page" class="form-control input-sm perPage filter-wrapper mr10" id="">
                                                    @php
                                                        $perPage = request('per_page')?? old('per_page');
                                                    @endphp
                                                    @for ($i = 20; $i<=200;$i+=20)
                                                        <option {{($perPage == $i)? 'selected':'' }} value="{{$i}}">{{$i}} bản ghi</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="action">
                                            <div class="uk-flex uk-flex-middle">
                                                <div class="uk-search uk-flex uk-flex-middle mr5">
                                                        @php
                                                            $user_catalogue_id = request('user_catalogue_id')?? old('user_catalogue_id');
                                                        @endphp
                                                    <select name="user_catalogue_id" id="" class="form-control setupSelect2">
                                                        <option value="" {{$user_catalogue_id==''? 'selected':''}}>Chọn nhóm thành viên</option>
                                                        @foreach ($userCatalogues as $userCatalogue)
                                                            <option value="{{$userCatalogue->id}}" {{$user_catalogue_id==$userCatalogue->id? 'selected':''}}>{{$userCatalogue->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="uk-search uk-flex uk-flex-middle mr5">
                                                    <select name="publish" id="" class="form-control setupSelect2">
                                                        @php
                                                            $publishs = [
                                                                'Bị khóa',
                                                                'Hoạt động',
                                                            ];
                                                            $publish = request('publish')?? old('publish');
                                                        @endphp
                                                            <option {{($publish == '')? 'selected':'' }} value="">Chọn tình trạng</option>
                                                            <option {{($publish == 1)? 'selected':'' }} value="1">Hoạt động</option>
                                                            <option {{($publish == 2)? 'selected':'' }} value="2">Bị khóa</option>
                                                    </select>
                                                </div>
                                                <div class="uk-search uk-flex uk-flex-middle mr5">
                                                    <div class="input-group">
                                                        <input type="text" name="keyword" value="{{ request('keyword')?? old('keyword') }}"
                                                        placeholder="Nhập từ khóa bạn tìm kiếm..." class="form-control">
                                                        <span class="input-group-btn">
                                                            <button type="submit" name="search" value="search" class="btn btn-success btn-sm">Tìm kiếm</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <a href="{{route('admin.user.create')}}" class="btn btn-primary"><i class="fa fa-plus">Thêm mới thành viên</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            {{-- End filter wrapper --}}

                            <table id="user_table" class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="thCheckbox">
                                            <input type="checkbox" id="checkAll" class="checkAll">
                                        </th>
                                        <th>ID</th>
                                        <th>Họ tên</th>
                                        <th>Hình ảnh</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Nhóm thành viên</th>
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
                                                <div class="user-item"><img src="{{$user->image}}" alt="" width="50px"></div>
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>
                                                @if ($user->user_catalogue_id==1) Quản trị viên
                                                @elseif ($user->user_catalogue_id==2) Cộng tác viên
                                                @else Khách hàng
                                                @endif
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
                            
                            {{ $users->links('pagination::bootstrap-4')}}

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
