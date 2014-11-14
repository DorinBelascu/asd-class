@extends('layout')

@section('content')

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Materiile Profesorului <span style="font-weight: bold;">{{ $profesor->nume . ' ' . $profesor->prenume }}</span> <span class="badge pull-right"> {{ $materii->count() }}</span> </div>
  
  <div class="panel-body">

  <!-- Table -->
  <div class="table-responsive">
  	<table class="table table-hover table-condensed table-striped">

	<thead>
		<tr>
			<th>#</th>
			<th>Materie ID</th>
			<th>Name</th>
			<th>Created at</th>
			<th>Updated at</th>
		</tr>
	</thead>

	<tbody>
	@foreach($materii as $i => $pm)
		
	    <tr>
	      <td>{{ $i+1 }}</td>
	      <td>{{ $pm->Materie->id }}</td>
	      <td>{{ $pm->Materie->denumirea}}</td>
	      <td>{{ $pm->Materie->created_at}}</td>
	      <td>{{ $pm->Materie->updated_at}}</td>
	    </tr>
    
 	@endforeach
	</tbody>


  	</table>
  </div>  
  </div>  

</div>

@stop