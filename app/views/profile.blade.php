@extends('layout')

@section('content')

{{ Form::open(['url'=> URL::route('profile-update'), 'class' => 'form']) }}
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<div class="row">
				@if(Session::has('result'))
				<div class="alert alert-success col-md-12" role="alert">{{Session::get('result')}}</div>
				@endif
				<div class="col-md-12">
				 Prenume
				 {{ Form::text('first_name', $current_user->first_name, array('class' => "form-control", 'placeholder' => "")) }}
					 @if ($errors->has('first_name'))
						<span class="error-message">{{ $errors->first('first_name') }}</span>
					 @endif
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				 Nume
				 {{ Form::text('last_name', $current_user->last_name, array('class' => "form-control", 'placeholder' => "")) }}
					@if ($errors->has('last_name'))
						<span class="error-message">{{ $errors->first('last_name') }}</span>
					@endif
				</div>
			</div>

			<div class='row text-center'>
				{{ Form::submit('Save', array('name' => "save", 'class' => "btn btn-primary")) }}
			</div>
		</div>
		<div class="col-md-4">
		</div>
	</div>
{{ Form::close() }}

{{ Form::open(['url'=> URL::route('password-update'), 'class' => 'form']) }}
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<div class="row">
				@if(Session::has('password_result'))
				<div class="alert alert-success col-md-12" role="alert">{{Session::get('password_result')}}</div>
				@endif
				<div class="col-md-12">
  				{{ Form::password('password', array('class' => "form-control", 'placeholder' => "Password")) }}
         		@if ($errors->has('password'))
            		<span class="error-message">{{ $errors->first('password') }}</span>
         		@endif
  				</div>
			</div>
			<div class="row">
  				<div class="col-md-12">
  				{{ Form::password('new_password', array('class' => "form-control", 'placeholder' => "New Password")) }}
         		 @if ($errors->has('new_password'))
            		<span class="error-message">{{ $errors->first('new_password') }}</span>
         		 @endif
  				</div>
			</div>
			<div class="row">
  				<div class="col-md-12">
  				{{ Form::password('new_password_confirmed', array('class' => "form-control", 'placeholder' => "Confirm New Password")) }}
         		 @if ($errors->has('new_password_confirmed'))
            		<span class="error-message">{{ $errors->first('new_password_confirmed') }}</span>
         		 @endif
  				</div>
			</div>
			<div class='row text-center'>
				{{ Form::submit('Save', array('name' => "save", 'class' => "btn btn-primary")) }}
			</div>
		</div>
		<div class="col-md-4">
		</div>
	</div>
{{ Form::close() }}

@stop