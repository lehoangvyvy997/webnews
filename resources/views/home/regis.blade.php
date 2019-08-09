@extends('home.master')
@section('title','Register')
@section('content')
<div class="col-lg-8">
        <h2 style="margin-top:50px">Register</h2>
        <form action="{{route('home.post.regis')}}" method="POST">
            {{ csrf_field() }}
          <div class="form-group">
            <label for="email">Username:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter username" name="username">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
          </div>
          <div class="form-group">
            <label for="pwd">Re Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="repassword">
          </div>
          @if (count($errors) > 0)
          <div class="alert alert-danger span8">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              @foreach ($errors->all() as $error)
                  {{ $error }}<br>
              @endforeach
          </div>
          @endif
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
</div>
@endsection