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
                                    <li><a href="#" class="changeStatusAll" data-model="User" data-value="1" data-field="publish">Turn on all</a>
                                    </li>
                                    <li><a href="#" class="changeStatusAll" data-model="User" data-value="0" data-field="publish">Turn off all</a>
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
                                                    <select name="user_catelogue_id" id="" class="form-control setupSelect2">
                                                        <option value="0" selected>Chọn nhóm thành viên</option>
                                                        <option value="1">Quản trị viên</option>
                                                        <option value="2">Khách hàng</option>
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
                                        <th class="text-center">Tình trạng</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <input type="checkbox" id="checkbox{{$user->id}}" class="input-checkbox">
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
                                            <td class="text-center">
                                                <input type="checkbox" class="js-switch status" data-field="publish" data-id={{$user->id}} data-model="User" value="{{$user->publish}}"
                                                {{$user->publish? 'checked':''}}>
                                            </td>
                                            <td class="text-center">
                                                {{-- <form action="{{route('admin.user.destroy', $user->id)}}" method="post"> --}}
                                                    {{-- @csrf  @method('DELETE') --}}
                                                    <a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                    <button data-toggle="modal" data-target="#confirmDeleteModal{{$user->id}}"
                                                        data-id={{$user->id}}
                                                        class="btn btn-danger confirmDelete"><i class="fa fa-trash"></i></button>
                                                {{-- </form> --}}
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
    
    @foreach ($users as $user)
            
        <!-- Update Modal -->
        {{-- <div class="modal fade" id="updateUserModal{{$user->id}}" value="{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="updateUserModal{{$user->id}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateUserModal{{$user->id}}Label">Xác nhận xóa dữ liệu mã ID: {{$user->id}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <form action="{{route('admin.user.destroy', $user->id)}}" method="post">
                        <a type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</a>
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--End Update Modal -->

        <!-- Delete Confirmation Modal -->
        {{-- <div class="modal fade" id="confirmDeleteModal{{$user->id}}" value="{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModal{{$user->id}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModal{{$user->id}}Label">Xác nhận xóa dữ liệu mã ID: {{$user->id}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa dữ liệu này?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('admin.user.destroy', $user->id)}}" method="post">
                        <a type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</a>
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--End Delete Confirmation Modal -->
    @endforeach

@endsection

@push('customCSS')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


@endpush

@push('customJS')
    <script src="{{asset('admin/js/plugins/switchery/switchery.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endpush
