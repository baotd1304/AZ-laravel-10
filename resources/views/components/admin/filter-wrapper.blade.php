<form action="{{route('admin.user.index')}}">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="perPage">
                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                    <select name="per_page" class="form-control input-sm perPage filter-wrapper mr10" id="">
                        @php
                            $perPage = request('per_page')?? old('per_page');
                        @endphp
                        @for ($i = 15; $i<=200;$i+=15)
                            <option {{($perPage == $i)? 'selected':'' }} value="{{$i}}">{{$i}} bản ghi</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    @if (isset($userCatalogues) && !empty($userCatalogues))
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
                    @endif
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
                    @if (isset($route) && !empty($route))
                        <a href="{{route('admin.'.$route.'.create')}}" class="btn btn-primary"><i class="fa fa-plus"> Thêm mới</i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>