@extends('layout.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <h3 class="page-header">Tài khoản</h3> 
     
        <div id="user-all">
            @include('admin.user.list')
        </div>
    </div>
</div>

<script src="{!! asset('js/user.js') !!}"></script>
<script>
    var user = new user;
    user.init();
</script>
@stop
