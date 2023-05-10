<div class="text-end">
    <a class="btn btn-sm btn-default" href="{{route('admin.measures.edit', $id)}}">
        <i class="fa fa-edit"></i>
    </a>
    <button type="button" class="btn btn-danger btn-sm remove" onclick="callDeleteAlert('{{$id}}');">
        <i class="fa fa-trash"></i>
    </button>
</div>
