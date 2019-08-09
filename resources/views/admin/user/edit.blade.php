@extends('admin.master')
@section('title','Edit User')
@section('content')
<div class="module">
    <div class="module-head">
        <h3> <i style="color:red">{{$user['username']}}</i> Profile</h3>
    </div>
    <div class="module-body">
        <form class="form-horizontal row-fluid" action="{{route('admin.user.post.edit',$user['id'])}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="control-group">
                <label class="control-label" for="basicinput">Fullname</label>
                <div class="controls">
                    <input type="text" id="basicinput" 
                    @if($user['fullname'])
                    value="{{$user['fullname']}}"
                    @endif
                    name="fullname" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Age</label>
                <div class="controls">
                    <input type="text" id="basicinput" 
                    @if($user['age'])
                    value="{{$user['age']}}"
                    @endif
                    name="age" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Avatar</label>
                <div class="controls">
                    <input type="file" style="display:none;" id="basicinput" name="avatar" class="span8 img-upload" >
                    <br>
                    <img style="padding: 10px 10px;
                    background-color: white;
                    box-shadow: 0 1px 3px rgba(34, 25, 25, 0.4);
                    -moz-box-shadow: 0 1px 2px rgba(34,25,25,0.4);
                    -webkit-box-shadow: 0 1px 3px rgba(34, 25, 25, 0.4);" class="img-bnupload" 
                    @if($user['avatar'])
                    src="{{asset($user['avatar'])}}"
                    @endif
                    @if(!$user['avatar'])
                    src="{{asset('admin_layout/images/default.png')}}"
                    @endif
                    width="50px" height="50px">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Email</label>
                <div class="controls">
                    <input type="text" id="basicinput" 
                    @if($user['email'])
                    value="{{$user['email']}}"
                    @endif
                     name="email" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Facebook</label>
                <div class="controls">
                    <input type="text" id="basicinput" 
                    @if($user['facebook'])
                    value="{{$user['facebook']}}"
                    @endif
                     name="facebook" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Github</label>
                <div class="controls">
                    <input type="text" id="basicinput" 
                    @if($user['github'])
                    value="{{$user['github']}}"
                    @endif
                     name="github" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Skype</label>
                <div class="controls">
                    <input type="text" id="basicinput" 
                    @if($user['skype'])
                    value="{{$user['skype']}}"
                    @endif
                     name="skype" placeholder="Type something here..." class="span8">
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
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
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
@section('script')
    $('.img-bnupload').click(function(){
        $('.img-upload').click();
        //var a = $('input[type="file"]').val();
        //$(".img-bnupload").attr("src",a);
    });
    $('.img-upload').change( function(event) {
        var tmppath = URL.createObjectURL(event.target.files[0]);
            $(".img-bnupload").fadeIn("fast").attr('src',tmppath);       
        });
@endsection