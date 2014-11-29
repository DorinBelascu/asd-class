@extends('layout')

@section('content')

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Profesorii care predau <span style="font-weight: bold;">{{ $materie->denumirea }}</span> <span class="badge pull-right"> {{ $profesori->count() }}</span> </div>
  

  <div class="panel-body">
	<div class="alert alert-info" role="alert">
  		@if( count($lista) )
  			<button class="btn btn-success" data-toggle="modal" rel="tooltip" data-placement="top" title="Add New Teacher To {{ $materie->denumirea }}"  data-target="#myModal"> <span class="glyphicon glyphicon-plus-sign"></span></button>
  		@endif
  	</div>

  	@include('materii.profesori.adaugare')
  <!-- Table -->
  	<div class="table-responsive">
		<table class="table table-hover table-condensed table-striped">

		<thead>
			<tr>
				<th>#</th>
				<th>Profesor ID</th>
				<th>Name</th>
				<th>Forename</th>
				<th>Data Nasterii</th>
				<th>Created at</th>
				<th>Updated at</th>
				<th class="text-center">Actions</th>
			</tr>
		</thead>

		<tbody>
		@foreach($profesori as $i => $pm)

			<tr>
			  <td>{{ $i+1 }}</td>
			  <td>{{ $pm->Profesor->id }}</td>
			  <td>{{ $pm->Profesor->nume}}</td>
			  <td>{{ $pm->Profesor->prenume}}</td>
			  <td>{{ $pm->Profesor->{"data nasterii"} }}</td>
			  <td>{{ $pm->Profesor->created_at}}</td>
			  <td>{{ $pm->Profesor->updated_at}}</td>
			  <td class="text-center">
          			<button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $pm->id }}"" data-placement="top" title="Delete this teacher ({{ $pm->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
          		</td>
			</tr>

			@include('materii.profesori.delete')

		@endforeach
		</tbody>


		</table>
	</div>  
  </div>  

</div>

@stop