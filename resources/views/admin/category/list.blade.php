@extends('admin.master')
@section('title','List category')
@section('content')
<div class="module">
    <div class="module-head">
        <h3>List Category</h3>
    </div>
    <div class="module-body table">
        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th width="15%">Work</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cate as $key => $val)
                    <tr class="odd gradeX">
                        <td width="5%">{{$key}}</td>
                        <td>{{$val->cate}}</td>
                        <td>
                            @if($val->status == 0)
                                Ẩn
                            @endif
                            @if($val->status == 1)
                                Hoạt Động
                            @endif
                        </td>
                        <td width="15%">
                            <a href="{{route('admin.category.get.edit',$val->id)}}" class="btn btn-small btn-info">edit</a>
                            <a href="{{route('admin.category.get.delete',$val->id)}}" class="btn btn-small btn-danger xacnhan">delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th >STT</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th width="15%">Work</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection