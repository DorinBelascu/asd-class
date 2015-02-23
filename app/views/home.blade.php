@extends('layout')

@section('content')

@if(Session::has('result'))
  		<div class="alert alert-success" role="alert">{{Session::get('result')}}</div>
@endif
<div class="jumbotron">
	<div class="row">
		<div class="text-center">
			<h1>Bine ai venit!</h1>
		</div>
	</div>
	<div class="row">
		<div class="text-center">
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			{{HTML::image('images/asdclass.png', 'ASD Class', ['width' => '100%', 'title' => 'ASD Class'])}}
		</div>
		<div class="col-md-4">
		</div>
	</div>
	<div class="row">
		<div class="text-center">
			
		</div>
	</div>
	<div class="row">
		<div class="text-center">
			
		</div>
	</div>
	<div class="row">
		<div class="text-center">
			
		</div>
	</div>
	<div class="row">
		<div class="text-center">
			<blockquote>
				<footer>Proiect realizat de: <cite title="Source Title">Andra Andrus, Stefan Maftei si Dorin Belascu</cite>
				</footer>
			</blockquote>
		</div>
	</div>
</div>
@stop