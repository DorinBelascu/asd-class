@extends('layout')

@section('content')

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Profesori <span class="badge pull-right"> {{ $profesori->getTotal() }}</span> </div>
  

  <div class="panel-body">
  	  	<p> 
  		Current page:<strong> {{$profesori->getCurrentPage()}} </strong>, 
  		Last page:<strong> {{$profesori->getLastPage()}} </strong>, 
  		Items per page:<strong> {{$profesori->getPerPage()}} </strong>, 
  		Total items:<strong> {{$profesori->getTotal()}} </strong>, 
  		From <strong> {{$profesori->getFrom()}} </strong> 
  		To <strong> {{$profesori->getTo()}} </strong>, 
  		Count: <strong> {{$profesori->count()}} </strong>.
  		</p>
  		<div class="alert alert-info" role="alert">
  			<a href="{{URL::route('add-new-profesor')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Add New Subject"> <span class="glyphicon glyphicon-plus-sign"></span></a>
  		</div>
  <!-- Table -->
  <div class="table-responsive">
  	<table class="table table-hover table-condensed table-striped">

	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Name</th>
			<th>Forename</th>
			<th>Data Nasterii</th>
			<th>Created at</th>
			<th>Updated at</th>
			<th class="text-center">Actions</th>
		</tr>
	</thead>

<tbody>
	@foreach($profesori as $i => $profesor)
        <tr>
          <td>{{ $i+1 }}.</td>
          <td>{{ $profesor->id }}</td>
          <td>{{ $profesor->nume}}</td>
          <td>{{ $profesor->prenume}}</td>
          <td>{{ $profesor->{"data nasterii"} }} </td>
          <td>{{ $profesor->created_at}}</td>
          <td>{{ $profesor->updated_at}}</td>
          <td class="text-center">
          	<a href="#" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit this subject ({{ $profesor->id }})"> <span class="glyphicon glyphicon-pencil"></span></a>
          	<a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete this subject ({{ $profesor->id }})"> <span class="glyphicon glyphicon-trash"></span></a>
          </td>
        </tr>
    @endforeach   
      </tbody>


  	</table>
  </div>  
  </div>


<div class="panel-footer text-center">{{ $profesori->links() }}</div>
  

</div>

@stop

@section('js')
<script> 
	$('a').tooltip();
</script>
@stop