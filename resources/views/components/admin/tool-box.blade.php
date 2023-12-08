<div class="ibox-title">
    <h5>{{ $tableHeading }}</h5>
    <div class="ibox-tools">
        <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
        </a>
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-wrench"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="#" id="changeStatusAll" class="changeStatusAll" data-model="{{$model}}" data-value="1" data-field="publish">Publish đã chọn</a>
            </li>
            <li><a href="#" class="changeStatusAll" data-model="{{$model}}" data-value="2" data-field="publish">Unpublish đã chọn</a>
            </li>
            <li><a href="#" class="deleteChecked" data-model="{{$model}}" data-value="delete" data-field="deleted_at">Xóa đã chọn</a>
            </li>

        </ul>
        <a class="close-link">
            <i class="fa fa-times"></i>
        </a>
    </div>
</div>