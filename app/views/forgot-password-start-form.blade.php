@extends('layout')

@section('content')

{{ Form::open(['url'=> URL::route('show-forgot-password-form-post'), 'class' => 'form']) }}
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
  		
  		<div class='row text-center'>
  			{{ Form::submit('Trimite', array('name' => "Trimite", 'class' => "btn btn-primary")) }}
  		</div>
  		
  	</div>
  	<div class="col-md-4">
  	</div>
  </div>
{{ Form::close() }}

@stop