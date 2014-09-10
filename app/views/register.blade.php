@extends('layout')

@section('content')

{{ Form::open(['url'=> '#', 'class' => 'form']) }}
  <div class="row">
  	<div class="col-md-4">
  	</div>
  	<div class="col-md-4">
  		<div class="row">
  			<div class="col-md-6">
  				{{ Form::text('first_name', null, array('class'=>'form-control', 'placeholder' => "First Name")) }}
  			</div>
  			<div class="col-md-6">
  				{{ Form::text('last_name', null, array('class'=>'form-control', 'placeholder' => "Last Name")) }}
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12">
  			{{ Form::email('email', null, array('class' => "form-control", 'placeholder' => "Email")) }}
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12">
  			{{ Form::email('email_confirmed', null, array('class' => "form-control", 'placeholder' => "Email Confirmed")) }}
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12">
  			{{ Form::password('password', array('class' => "form-control", 'placeholder' => "Password")) }}
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12">
  			{{ Form::password('password_confirmed', array('class' => "form-control", 'placeholder' => "Password Confirmed")) }}
  			</div>
  		</div>
  		<div class='row text-center'>
  			{{ Form::submit('Create account', array('name' => "create_account", 'class' => "btn btn-primary")) }}
  		</div>
  	</div>
  	<div class="col-md-4">
  	</div>
  </div>
{{ Form::close() }}

@stop