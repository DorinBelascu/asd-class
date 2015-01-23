@extends('layout')

@section('content')

<div class="panel panel-primary">
  <div class="panel-heading">Selecteaza o materie</div>
  <div class="panel-body">
  	<div class="row">
  	@foreach($materii as $i => $materie)
	  	<div class="col-md-3 col-xs-6">
		        <div style="text-align:center; margin:4px auto">
	          		<div class="btn-group">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					    {{ $materie->denumirea}} <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" role="menu">
					    <li>{{ HTML::link(URL::route('catalog-note',[
					    	'denumirea'  => $materie->denumirea, 
					    	'id_elev'    => $id,
					    	'id_materie' => $materie->id]), 'Note ...') }}</li>
					    <li class="divider"></li>
					    <li>{{ HTML::link(URL::route('catalog-absente',[
					    	'denumirea'  => $materie->denumirea, 
					    	'id_elev'    => $id,
					    	'id_materie' => $materie->id]), 'Absente ...') }}</li>
					    <li></li>
					  </ul>
					</div>
		        </div>
		</div>
	@endforeach
	</div>
  </div>
</div>

@stop