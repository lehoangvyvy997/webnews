@extends('admin.master')
@section('title','Create admin')
@section('content')
<div class="module">
    <div class="module-head">
        <h3>Create admin</h3>
    </div>
    <div class="module-body">
        <form class="form-horizontal row-fluid" action="{{route('admin.info.post.create')}}" method="POST">
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
                <label class="control-label" for="basicinput">Level</label>
                <div class="controls">
                    <select tabindex="1" data-placeholder="Select here.." class="span4" name="level">
                        <option value="">Select here..</option>
                        <option value="1" >Lv1-Normal Admin</option>
                        <option value="2" >Lv2-Admin</option>
                        <option value="3" >Lv3-Super Admin</option>
                    </select>
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