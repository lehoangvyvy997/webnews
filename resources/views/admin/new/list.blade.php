@extends('admin.master')
@section('title','List new')
@section('content')
<div class="module">
    <div class="module-head">
        <h3>List news</h3>
    </div>
    <div class="module-body table">
        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
            <thead>
                <tr>
                    <th width="3%">STT</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Avatar</th>
                    <th>Status</th>
                    <th width="7%">Work</th>
                </tr>
            </thead>
            <tbody>
                @foreach($new as $key => $val)
                <tr class="odd gradeX">
                    <td width="3%">{{$key}}</td>
                    <td>{{$val->title}}</td>
                    <td>{{$val->description}}</td>
                    <td>{{$val->author}}</td>
                    <td>{{$val->category}}</td>
                    <td><img src="{{asset($val->avatar)}}" width="50px" height="50px"></td>
                    <td>
                        @if($val->status == 0)
                            Ẩn
                        @endif
                        @if($val->status == 1)
                            Hoạt Động
                        @endif
                    </td>
                    <td width="7%">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Tasks
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu" style="width:67px;min-width:0px;">
                                <li><a href="{{route('admin.new.get.edit',$val->id)}}">edit</a>
                                <li class="divider"></li>
                                <li class="xacnhan"><a href="{{route('admin.new.get.delete',$val->id)}}">delete</a>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th width="3%">STT</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Avatar</th>
                    <th>Status</th>
                    <th width="7%">Work</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection