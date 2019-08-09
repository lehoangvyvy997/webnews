@extends('home.master')
@foreach($new as $val)
@section('title',$val->title)
@section('content')
<!-- Post Content Column -->
<div class="col-lg-8">

    <!-- Title -->
    <h1 class="mt-4">{{$val->title}}</h1>

    <!-- Author -->
    <p class="lead">
      by
      <b>{{$val->author}}</b>
    </p>

    <hr>

    <!-- Date/Time -->
    <p>Posted on <i>{{$val->created_at}}</i><i class="fas fa-eye" style="margin-left:20px"></i>{{$val->view}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="card-img-top" src="{{asset($val->avatar)}}" height="300px" alt="">

    <hr>

    <!-- Post Content -->
    <?php echo $val->content;?>
    <hr>

    <!-- Comments Form -->
    <div class="card my-4">
      <h5 class="card-header">Leave a Comment:</h5>
      <div class="card-body">
        <form action="{{route('home.post.comment',$val->id)}}" method="POST">
            {{ csrf_field() }}
          <div class="form-group">
            <textarea class="form-control" rows="3" id="cmt" name="content" onblur="checkcmt();"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" id="bncmt" disabled>Submit</button>
        </form>
      </div>
    </div>
    @foreach($cmt as $key => $val)
      @foreach($user as $val2)
        @if($val->user_id === $val2->id)
          <!-- Single Comment -->
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" 
            @if(!$val2->avatar)
            src="{{asset('admin_layout/images/default.png')}}"
            @endif
            @if($val2->avatar)
            src="{{asset($val2->avatar)}}"
            @endif
             alt="" width="50px" height="50px">
            <div class="media-body">
              <h5 class="mt-0">{{$val2->username}}</h5>
              {{$val->content}}<br>
              <small><i>{{$val->updated_at}}</i></small>
            </div>
          </div>
        @endif
      @endforeach
    @endforeach

  </div>
@endsection
@section('js')
<script>
    function checkcmt(){
      var a = document.getElementById('cmt').value;
      if(a){
        document.getElementById('bncmt').disabled = false;
      }
      else{
        document.getElementById('bncmt').disabled = true;
      }
    }
</script>
@endsection
@endforeach