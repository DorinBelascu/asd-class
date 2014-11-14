@extends('layout')

@section('content')

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Profesorii care predau Materia <span style="font-weight: bold;">{{ $materie->denumirea }}</span> <span class="badge pull-right"> {{ $profesori->count() }}</span> </div>
  

  <div class="panel-body">

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
	    </tr>
    
 	@endforeach
	</tbody>


  	</table>
  </div>  
  </div>  

</div>

@stop