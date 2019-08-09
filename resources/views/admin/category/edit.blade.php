@extends('admin.master')
@section('title','Category')
@section('content')
<div class="module">
    <div class="module-head">
        <h3>Category</h3>
    </div>
    <div class="module-body">
        <form class="form-horizontal row-fluid" action="{{route('admin.category.post.edit',$cate['id'])}}" method="POST">
                {{ csrf_field() }}
            <div class="control-group">
                <label class="control-label" for="basicinput">Category</label>
                <div class="controls">
                    <input type="text" 
                    @if(isset($cate['cate']))
                        value="{{$cate['cate']}}"
                    @endif
                    id="basicinput" name="cate" placeholder="Type something here..." class="span8">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="basicinput">Status</label>
                <div class="controls">
                    <select tabindex="1" data-placeholder="Select here.." class="span4" name="status">
                        <option value="">Select here..</option>
                        <option value="0" 
                        @if(isset($cate['status']) && $cate['status'] == 0)
                            <?php echo "selected"; ?>
                        @endif
                        >Ẩn</option>
                        <option value="1"
                        @if(isset($cate['status']) && $cate['status'] == 1)
                            <?php echo "selected"; ?>
                        @endif
                        >Hoạt Động</option>
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