@extends('layout')

@section('content')

<div class="row">
@if(Session::has('result-success'))
  <div class="alert alert-success col-md-12" role="alert">{{Session::get('result-success')}}</div>
@endif
</div>

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Materiile Profesorului <span style="font-weight: bold;">{{ $profesor->nume . ' ' . $profesor->prenume }}</span> <span class="badge pull-right"> {{ $materii->count() }}</span> </div>
  
  <div class="panel-body">
  	<div class="alert alert-info" role="alert">
  		<button class="btn btn-success" data-toggle="modal" rel="tooltip" data-placement="top" title="Add New Subject To {{ $profesor->nume . ' ' . $profesor->prenume }}"  data-target="#myModal"> <span class="glyphicon glyphicon-plus-sign"></span></button>
  	</div>

  	@include('profesori.materii.adaugare')

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
			<th class="text-center">Actions</th>
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
	      <td class="text-center">
          	<button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $pm->Materie->id }}"" data-placement="top" title="Delete this materie ({{ $pm->Materie->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
          </td>
	    </tr>

	    @include('profesori.materii.delete')
    
 	@endforeach
	</tbody>


  	</table>
  </div>  
  </div>  

</div>

@stop

@section('js')
<script>
  $('a').tooltip();
  $('button').tooltip();
  $('select').tooltip();
 </script>

@stop