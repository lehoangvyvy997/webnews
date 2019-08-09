@extends('admin.master')
@section('title','List user')
@section('content')
<div class="module">
    <div class="module-head">
        <h3>List user</h3>
    </div>
    <div class="module-body table">
        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
            <thead>
                <tr>
                    <th width="3%">STT</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Age</th>
                    <th>Avatar</th>
                    <th>Github</th>
                    <th>Facebook</th>
                    <th>Skype</th>
                    <th>Email</th>
                    <th width="7%">Work</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $key => $val)
                <tr class="odd gradeX">
                    <td width="3%">{{$key}}</td>
                    <td>{{$val->username}}</td>
                    <td>{{$val->fullname}}</td>
                    <td>{{$val->age}}</td>
                    <td><img src="{{asset($val->avatar)}}" width="50px" height="50px"></td>
                    <td><a href="{{$val->github}}">link</a></td>
                    <td><a href="{{$val->facebook}}">link</a></td>
                    <td><a href="{{$val->skype}}">link</a></td>
                    <td><a href="{{$val->email}}">link</a></td>
                    <td width="7%">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Tasks
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu" style="width:67px;min-width:0px;">
                                <li><a href="{{route('admin.user.get.edit',$val->id)}}">edit</a>
                                <li class="divider"></li>
                                <li class="xacnhan"><a href="{{route('admin.user.get.delete',$val->id)}}">delete</a>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th width="3%">STT</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Age</th>
                    <th>Avatar</th>
                    <th>Github</th>
                    <th>Facebook</th>
                    <th>Skype</th>
                    <th>Email</th>
                    <th width="7%">Work</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection