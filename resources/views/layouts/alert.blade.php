@if(count($errors)>0)
<div class="alert alert-danger mt-3 ">
    <ul class="pl-0 mb-0">
        @foreach($errors->all() as $error)
        <li style="list-style: none;">{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif
@if(session('err_message'))
<div class="alert alert-danger">{{session('err_message')}}</div>
@endif