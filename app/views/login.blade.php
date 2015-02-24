@extends('layout')

@section('content')

{{ Form::open(['url'=> URL::route('login-post'), 'class' => 'form']) }}
  <div class="row">
  	<div class="col-md-4">
  	</div>
  	<div class="col-md-4">
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
  			{{ Form::password('password', array('class' => "form-control", 'placeholder' => "Parola")) }}
          @if ($errors->has('password'))
            <span class="error-message">{{ $errors->first('password') }}</span>
          @endif
  			</div>
  		</div>
  		<div class='row text-center'>
  			{{ Form::submit('Conecteaza-te', array('name' => "login", 'class' => "btn btn-primary")) }}
  		</div>
  		@if(Session::has('result'))
  		<div class="alert alert-danger" role="alert">{{Session::get('result')}}</div>
  		@endif
        <div class='row text-center'>
        {{ HTML::link(URL::route('show-forgot-password-form'), 'Mi-am uitat parola') }}
        </div>
  	</div>
  	<div class="col-md-4">
  	</div>
  </div>
{{ Form::close() }}


@stop