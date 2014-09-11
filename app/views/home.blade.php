@extends('layout')

@section('content')
Home content...
@if(Session::has('result'))
  		<div class="alert alert-danger" role="alert">{{Session::get('result')}}</div>
@endif
@stop