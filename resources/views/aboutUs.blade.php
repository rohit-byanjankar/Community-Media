@extends('layouts.master')
@section('content')
<h1>COMMUNITY VISION</h1>
<p>
    {{config('basic_settings.CM_vision')}}
</p>

<h3>Contact Us:</h3>
<span>{{config('basic_settings.CM_phone_number')}}</span>
@endsection