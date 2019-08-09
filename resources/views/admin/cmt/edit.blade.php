@extends('admin.master')
@section('title','Comment')
@section('content')
<div class="module">
    <div class="module-head">
        <h3>Comment</h3>
    </div>
    <div class="module-body">
        <form class="form-horizontal row-fluid" action="{{route('admin.cmt.post.edit',$cmt['id'])}}" method="POST">
                {{ csrf_field() }}
            <div class="control-group">
                <label class="control-label" for="basicinput">Content</label>
                <div class="controls">
                    <input type="text" 
                    @if(isset($cmt['content']))
                        value="{{$cmt['content']}}"
                    @endif
                    id="basicinput" name="content" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">User id</label>
                <div class="controls">
                    <input type="text" 
                    @if(isset($cmt['user_id']))
                        value="{{$cmt['user_id']}}"
                    @endif
                    id="basicinput" name="user" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">New id</label>
                <div class="controls">
                    <input type="text" 
                    @if(isset($cmt['new_id']))
                        value="{{$cmt['new_id']}}"
                    @endif
                    id="basicinput" name="new" placeholder="Type something here..." class="span8">
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