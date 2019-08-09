@extends('admin.master')
@section('title','User')
@section('content')
<div class="module">
    <div class="module-head">
        <h3>Create User</h3>
    </div>
    <div class="module-body">
        <form class="form-horizontal row-fluid" action="{{route('admin.user.post.create')}}" method="POST">
                {{ csrf_field() }}
            <div class="control-group">
                <label class="control-label" for="basicinput">Username</label>
                <div class="controls">
                    <input type="text" id="basicinput" name="username" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                    <label class="control-label" for="basicinput">Password</label>
                    <div class="controls">
                        <input type="password" id="basicinput" name="password" placeholder="Type something here..." class="span8">
                    </div>
                </div>
                <div class="control-group">
                        <label class="control-label" for="basicinput">Re Password</label>
                        <div class="controls">
                            <input type="password" id="basicinput" name="repassword" placeholder="Type something here..." class="span8">
                        </div>
                    </div>
            <div class="control-group">
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox"  onchange="document.getElementById('cli').disabled = !this.checked;" />
                        Confirm
                    </label>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger span8">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button id="cli" type="submit" class="btn" disabled>Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection