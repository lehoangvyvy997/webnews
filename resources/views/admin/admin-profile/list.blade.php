@extends('admin.master')
@section('title','List Admin')
@section('css')
<style>
.online {
    height: 10px;
    width: 10px;
    border-radius: 50%;
    display: inline-block;
    background-color:green;
}
.offline {
    height: 10px;
    width: 10px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
}
.right{
    float: right;
    clear: both;
    cursor: pointer;
    text-decoration: none;
}
</style>
@endsection
@section('content')
<div class="module">
    <div class="module-head">
        <h3>
        All Admin <a href="{{route('admin.info.get.create')}}"><i class="icon-plus-sign right"></i></a></h3>
    </div>
    <div class="module-body">
        @foreach($check as $val)
        <div class="row-fluid">
            <div class="span12">
                <div class="media user">
                    <a class="media-avatar pull-left" href="{{route('admin.info.get.admininfo',$val->id
                    )}}">
                        <img 
                        @if(!$val->avatar)
                        src="{{asset('admin_layout/images/default.png')}}"
                        @endif
                        @if(
                        $val->avatar)
                        src="{{asset($val->avatar)}}"
                        @endif
                        >
                    </a>
                    <div class="media-body">
                        <h3 class="media-title">
                            {{$val->username}}
                            <small> <i>Lv {{$val->level}} </i>-<strong> 
                                    @if($val->level == 3)
                                    {{'Super Admin'}}
                                    @endif
                                    @if($val->level == 2)
                                    {{'Admin'}}
                                    @endif
                                    @if($val->level == 1)
                                    {{'Normal Admin'}}
                                    @endif
                                    </strong></small>
                            
				                
					                @if($val->isOnline())
					  	                <span class="online"></span>
					                @else
					  	                <span class="offline"></span>
					                @endif
				                
                            
                        </h3>
                        <p>
                            <small class="muted">
                                @if($val->fullname)
                                {{$val->fullname}}
                                @endif
                                @if(!$val->fullname)
                                ???
                                @endif
                                </small></p>
                        <div class="media-option btn-group shaded-icon">
                            <button class="btn btn-small">
                                <i class="icon-envelope"></i>
                            </button>
                            <button class="btn btn-small">
                                <i class="icon-remove"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection