@extends('adminlte::page')
@section('content')
<h1 class="text-dark text-center text-bold">MANAGE PERMISSIONS</h1>
@php
$permission_array=[];
foreach ($roles as $permission){
    {
        $role=$permission->role;
        if(!isset($permission_array[$role])){
        $permission_array[$role]=[];
        }
        $model=$permission->model;
        if(!isset($permission_array[$role][$model])){
        $permission_array[$role][$model]=[];
        }
        $permission_granted=$permission->permission_granted;
        array_push($permission_array[$role][$model],$permission_granted);
    }
}
@endphp
<form action="{{url('adminpanel/role-permission-save')}}" method="post">
    {{csrf_field()}}
    <h2 class="text-bold text-light-blue">Permission for {{$roleName}}</h2>
    @php
    $index=0;
    @endphp
    <div class="container">
        @foreach($permissions as $model=>$permission)
        <div class="col-md-5">
            <div class="box-header">
                @php
                $cname = str_replace('\\' , '-' , $model );
                @endphp
                <h5 class="text-bold"> <input type="checkbox" onclick="selectAll(this,'{{$cname}}')" />
                    {{$model}} </h5>
            </div>
            <div class="box-body">
                @foreach($permission as $permission_granted)
                <div class="checkbox no-margin no-padding">
                    <label><input type="checkbox" value="{{$index++}}" name="checked[]" class="{{$cname}}"
                    {{Helper::check($permission_granted,$roleName,$model,$permission_array)== true ? 'checked' :''}}>{{$permission_granted}}</label>
                    <input type="hidden" value="{{$roleName}}" name="role[]">
                    <input type="hidden" value="{{$permission_granted}}" name="permission_granted[]">
                    <input type="hidden" value="{{$model}}" name="model[]">
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
        <div class="col-md-12 ">
            <button class="btn btn-facebook text-success">Update Permissions</button>
        </div>
    </div>
</form>

<script>
    function selectAll(ob, cn) {
        if ($(ob).prop("checked")) {
            $("." + cn).prop('checked', true);
        } else {
            $("." + cn).prop('checked', false);
        }
    }
</script>
@endsection