@extends('layout')

@section('content')

{{ Form::open(['url'=> URL::route('register-post'), 'class' => 'form']) }}
  <div class="row">
  	<div class="col-md-4">
  	</div>
  	<div class="col-md-4">
  		<div class="row">
  			<div class="col-md-6">
  				{{ Form::text('first_name', null, array('class'=>'form-control', 'placeholder' => "First Name")) }}
          @if ($errors->has('first_name'))
            <span class="error-message">{{ $errors->first('first_name') }}</span>
          @endif
  			</div>
  			<div class="col-md-6">
  				{{ Form::text('last_name', null, array('class'=>'form-control', 'placeholder' => "Last Name")) }}
            @if ($errors->has('last_name'))
              <span class="error-message">{{ $errors->first('last_name') }}</span>
            @endif
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12">
  			 {{ Form::email('email', null, array('class' => "form-control", 'placeholder' => "Email")) }}
           @if ($errors->has('email'))
              <span class="error-message">{{ $errors->first('email') }}</span>
           @endif
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12">
  			{{ Form::email('email_confirmed', null, array('class' => "form-control", 'placeholder' => "Email Confirmed")) }}
          @if ($errors->has('email_confirmed'))
            <span class="error-message">{{ $errors->first('email_confirmed') }}</span>
          @endif
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12">
  			{{ Form::password('password', array('class' => "form-control", 'placeholder' => "Password")) }}
          @if ($errors->has('password'))
            <span class="error-message">{{ $errors->first('password') }}</span>
          @endif
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12">
  			{{ Form::password('password_confirmed', array('class' => "form-control", 'placeholder' => "Password Confirmed")) }}
          @if ($errors->has('password_confirmed'))
            <span class="error-message">{{ $errors->first('password_confirmed') }}</span>
          @endif
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