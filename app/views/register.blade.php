@extends('layout')

@section('content')

{{ Form::open(['url'=> URL::route('register-post'), 'class' => 'form']) }}
  <div class="row">
  	<div class="col-md-4">
  	</div>
  	<div class="col-md-4">
  		<div class="row">
  			<div class="col-md-6">
  				{{ Form::text('first_name', null, array('class'=>'form-control', 'placeholder' => "Prenume")) }}
          @if ($errors->has('first_name'))
            <span class="error-message">{{ $errors->first('first_name') }}</span>
          @endif
  			</div>
  			<div class="col-md-6">
  				{{ Form::text('last_name', null, array('class'=>'form-control', 'placeholder' => "Nume")) }}
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
  			{{ Form::email('email_confirmed', null, array('class' => "form-control", 'placeholder' => "Email Confirmat")) }}
          @if ($errors->has('email_confirmed'))
            <span class="error-message">{{ $errors->first('email_confirmed') }}</span>
          @endif
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12">
  			{{ Form::password('password', array('class' => "form-control", 'placeholder' => "Parola")) }}
          @if ($errors->has('password'))
            <span class="error-message">{{ $errors->first('password') }}</span>
          @endif
  			</div>
  		</div>
  		<div class="row">
  			<div class="col-md-12">
  			{{ Form::password('password_confirmed', array('class' => "form-control", 'placeholder' => "Parola Confirmata")) }}
          @if ($errors->has('password_confirmed'))
            <span class="error-message">{{ $errors->first('password_confirmed') }}</span>
          @endif
  			</div>
  		</div>
      <div class="row">
          <div class="col-md-12 text-center">
            <div> Ce sunteti? </div>
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-success active">
              {{ Form::radio('user_type', 'elev', true, ['id' => "elev", 'autocomplete' => "off"]) }}
              Elev
            </label>
            <label class="btn btn-success">
              {{ Form::radio('user_type', 'profesor', false, ['id' => "elev", 'autocomplete' => "off"]) }}
              Profesor
            </label>
          </div>
        </div>
      </div>
  		<div class="row text-center" style="margin-top:20px">
  			{{ Form::submit('Creeaza cont', array('name' => "create_account", 'class' => "btn btn-primary")) }}
  		</div>
  	</div>
  	<div class="col-md-4">
  	</div>
  </div>
{{ Form::close() }}

@stop