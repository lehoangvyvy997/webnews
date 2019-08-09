@extends('admin.master')
@section('title','Edit profile')
@section('content')
<div class="module">
    <div class="module-head">
        <h3> <i style="color:red">{{$admin['username']}}</i> Profile</h3>
    </div>
    <div class="module-body">
        <form class="form-horizontal row-fluid" action="{{route('admin.info.post.edit')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="control-group">
                <label class="control-label" for="basicinput">Fullname</label>
                <div class="controls">
                    <input type="text" id="basicinput" 
                    @if($admin['fullname'])
                    value="{{$admin['fullname']}}"
                    @endif
                    name="fullname" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Age</label>
                <div class="controls">
                    <input type="text" id="basicinput" 
                    @if($admin['age'])
                    value="{{$admin['age']}}"
                    @endif
                    name="age" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Position</label>
                <div class="controls">
                    <input type="text" id="basicinput"
                    @if($admin['position'])
                    value="{{$admin['position']}}"
                    @endif
                     name="position" placeholder="Type something here..." class="span8">
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
                    @if($admin['avatar'])
                    src="{{asset($admin['avatar'])}}"
                    @endif
                    @if(!$admin['avatar'])
                    src="{{asset('admin_layout/images/default.png')}}"
                    @endif
                    width="50px" height="50px">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Email</label>
                <div class="controls">
                    <input type="text" id="basicinput" 
                    @if($admin['email'])
                    value="{{$admin['email']}}"
                    @endif
                     name="email" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Facebook</label>
                <div class="controls">
                    <input type="text" id="basicinput" 
                    @if($admin['facebook'])
                    value="{{$admin['facebook']}}"
                    @endif
                     name="facebook" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Github</label>
                <div class="controls">
                    <input type="text" id="basicinput" 
                    @if($admin['github'])
                    value="{{$admin['github']}}"
                    @endif
                     name="github" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Skype</label>
                <div class="controls">
                    <input type="text" id="basicinput" 
                    @if($admin['skype'])
                    value="{{$admin['skype']}}"
                    @endif
                     name="skype" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Status</label>
                <div class="controls">
                    <textarea name="status" class="span12" 
                    cols="5">@if($admin['status']){{$admin['status']}}@endif</textarea>
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