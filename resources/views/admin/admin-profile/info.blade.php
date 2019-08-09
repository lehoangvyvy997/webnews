@extends('admin.master')
@section('title','Your info')
@section('css')
<style>
.panel {
  box-shadow: none;
}
.panel-heading {
  border-bottom: 0;
}
.panel-title {
  font-size: 17px;
}
.panel-title > small {
  font-size: .75em;
  color: #999999;
}
.panel-body *:first-child {
  margin-top: 0;
}
.panel-footer {
  border-top: 0;
}

.panel-default > .panel-heading {
    color: #333333;
    background-color: transparent;
    border-color: rgba(0, 0, 0, 0.07);
}

/**
 * Profile
 */
/*** Profile: Header  ***/
.profile__avatar {
  float: left;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  margin-right: 20px;
  overflow: hidden;
}
@media (min-width: 768px) {
  .profile__avatar {
    width: 100px;
    height: 100px;
  }
}
.profile__avatar > img {
  width: 100%;
  height: auto;
}
.profile__header {
  overflow: hidden;
}
.profile__header p {
  margin: 20px 0;
}
/*** Profile: Table ***/
@media (min-width: 992px) {
  .profile__table tbody th {
    width: 200px;
  }
}
/*** Profile: Recent activity ***/
.profile-comments__item {
  position: relative;
  padding: 15px 16px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}
.profile-comments__item:last-child {
  border-bottom: 0;
}
.profile-comments__item:hover,
.profile-comments__item:focus {
  background-color: #f5f5f5;
}
.profile-comments__item:hover .profile-comments__controls,
.profile-comments__item:focus .profile-comments__controls {
  visibility: visible;
}
.profile-comments__controls {
  position: absolute;
  top: 0;
  right: 0;
  padding: 5px;
  visibility: hidden;
}
.profile-comments__controls > a {
  display: inline-block;
  padding: 2px;
  color: #999999;
}
.profile-comments__controls > a:hover,
.profile-comments__controls > a:focus {
  color: #333333;
}
.profile-comments__avatar {
  display: block;
  float: left;
  margin-right: 20px;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  overflow: hidden;
}
.profile-comments__avatar > img {
  width: 100%;
  height: auto;
}
.profile-comments__body {
  overflow: hidden;
}
.profile-comments__sender {
  color: #333333;
  font-weight: 500;
  margin: 5px 0;
}
.profile-comments__sender > small {
  margin-left: 5px;
  font-size: 12px;
  font-weight: 400;
  color: #999999;
}
@media (max-width: 767px) {
  .profile-comments__sender > small {
    display: block;
    margin: 5px 0 10px;
  }
}
.profile-comments__content {
  color: #999999;
}
/*** Profile: Contact ***/
.profile__contact-btn {
  padding: 12px 20px;
  margin-bottom: 20px;
}
.profile__contact-hr {
  position: relative;
  border-color: rgba(0, 0, 0, 0.1);
  margin: 40px 0;
}
.profile__contact-hr:before {
  content: "OR";
  display: block;
  padding: 10px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  background-color: #f5f5f5;
  color: #c6c6cc;
}
.profile__contact-info-item {
  margin-bottom: 30px;
}
.profile__contact-info-item:before,
.profile__contact-info-item:after {
  content: " ";
  display: table;
}
.profile__contact-info-item:after {
  clear: both;
}
.profile__contact-info-item:before,
.profile__contact-info-item:after {
  content: " ";
  display: table;
}
.profile__contact-info-item:after {
  clear: both;
}
.profile__contact-info-icon {
  float: left;
  font-size: 18px;
  color: #999999;
}
.profile__contact-info-body {
  overflow: hidden;
  padding-left: 20px;
  color: #999999;
}
.profile__contact-info-body a {
  color: #999999;
}
.profile__contact-info-body a:hover,
.profile__contact-info-body a:focus {
  color: #999999;
  text-decoration: none;
}
.profile__contact-info-heading {
  margin-top: 2px;
  margin-bottom: 5px;
  font-weight: 500;
  color: #999999;
}
hr {
	height: 10px;
	border: 0;
	box-shadow: 0 10px 10px -10px #8c8b8b inset;
}
.left{
    clear: both;
    float: right;
}
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
</style>
@endsection
@section('content')
<div class="module">
    <div class="module-body">
        <div class="col-xs-12 col-sm-9">
        
            <!-- User profile -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <h4 class="panel-title">Admin profile 
              <a href="{{route('admin.info.get.edit')}}" class="btn btn-primary left" style="color:antiquewhite;" >Edit</a>
            </h4>
              </div>
              <div class="panel-body">
                <div class="profile__avatar">
                  <img 
                    @if($admin['avatar'])
                      src="{{asset($admin['avatar'])}}"
                    @endif
                    @if(!$admin['avatar'])
                    src="{{asset('admin_layout/images/default.png')}}"
                    @endif
                   alt="...">
                </div>
                <div class="profile__header">
                  <h4>{{$admin['username']}}<small> <i>Lv {{$admin['level']}} </i>-<strong> 
                      @if($admin['level'] == 3)
                      {{'Super Admin'}}
                      @endif
                      @if($admin['level'] == 2)
                      {{'Admin'}}
                      @endif
                      @if($admin['level'] == 1)
                      {{'Normal Admin'}}
                      @endif
					  </strong></small>
					  @if($check)
				  
					  @if($check[0]->checkOnline($admin['id']))
					  	<span class="online"></span>
					  @endif
					  @if(!$check[0]->checkOnline($admin['id']))
					  	<span class="offline"></span>
					  @endif
				  
                @endif
					</h4>
                  <p class="text-muted">
                    @if($admin['status'])
                    {{$admin['status']}}
                    @endif
                    @if(!$admin['status'])
                    {{'???'}}
                    @endif
                  </p>
                  
                </div>
              </div>
            </div>
            <br><hr><br>
            <!-- User info -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <h4 class="panel-title">Admin info</h4>
              </div>
              <div class="panel-body">
                <table class="table profile__table">
                  <tbody>
                    <tr>
                        <th><strong>Fullname</strong></th>
                        <td>
                            @if($admin['fullname'])
                            {{$admin['fullname']}}
                            @endif
                            @if(!$admin['fullname'])
                            {{'???'}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                      <th><strong>Age</strong></th>
                      <td>
                            @if($admin['age'])
                            {{$admin['age']}}
                            @endif
                            @if(!$admin['age'])
                            {{'???'}}
                            @endif
                      </td>
                    </tr>
                    <tr>
                      <th><strong>Position</strong></th>
                      <td>
                            @if($admin['position'])
                            {{$admin['position']}}
                            @endif
                            @if(!$admin['position'])
                            {{'???'}}
                            @endif
                      </td>
                    </tr>
                    <tr>
                        <th><strong>Email</strong></th>
                        <td>
                            @if($admin['email'])
                                {{$admin['email']}}
                            @endif
                            @if(!$admin['email'])
                                ???
                            @endif
                        </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <br><hr><br>
            <!-- Community -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <h4 class="panel-title">Social Network</h4>
              </div>
              <div class="panel-body">
                <table class="table profile__table">
                  <tbody>
                    <tr>
                      <th><strong>Facebook</strong></th>
                      <td>
                        @if($admin['facebook'])
                            <a href="{{$admin['facebook']}}" target="blank">{{$admin['facebook']}}</a>
                        @endif
                        @if(!$admin['facebook'])
                            <a href="#">???</a>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <th><strong>Github</strong></th>
                      <td>
                        @if($admin['github'])
                            <a href="{{$admin['github']}}" target="blank">{{$admin['github']}}</a>
                        @endif
                        @if(!$admin['github'])
                            <a href="#">???</a>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <th><strong>Skype</strong></th>
                      <td>
                        @if($admin['skype'])
                            {{$admin['skype']}}
                        @endif
                        @if(!$admin['skype'])
                            ???
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
                <br><hr><br>
                <!-- Thong ke -->
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4 class="panel-title">statistical</h4>
                </div>
                <div class="panel-body">
                  <table class="table profile__table">
                    <tbody>
                      <tr>
                        <th><strong>Post</strong></th>
                        <td>{{$count}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
                  <br><hr><br>
            <!-- Latest posts -->
            <div class="panel panel-default">
              <div class="panel-heading">
              <h4 class="panel-title">Latest posts</h4>
              </div>
              <div class="panel-body">
                <div class="profile__comments">
                    @foreach($news as $key => $val)
                        <div class="profile-comments__item">
                            <div class="profile-comments__controls">
                            <a href="{{route('admin.new.get.edit',$val->id)}}"><i class="fa fa-edit"></i></a>
                            <a href="{{route('admin.new.get.delete',$val->id)}}" class="xacnhan"><i class="fa fa-trash-o"></i></a>
                            </div>
                            <div class="profile-comments__avatar">
                            <img src="{{asset($val->avatar)}}" alt="...">
                            </div>
                            <div class="profile-comments__body">
                            <h5 class="profile-comments__sender">
                                {{$val->title}}
                            </h5>
                            <div class="profile-comments__content">
                                {{$val->description}}
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
              </div>
            </div>
    
          </div>
          
    </div>
</div>
@endsection