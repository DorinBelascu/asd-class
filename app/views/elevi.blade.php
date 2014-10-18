@extends('layout')

@section('content')

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Elevi <span class="badge pull-right"> {{ $elevi->getTotal() }}</span> </div>
  

  <div class="panel-body">
  	  	<p> 
  		Current page:<strong> {{$elevi->getCurrentPage()}} </strong>, 
  		Last page:<strong> {{$elevi->getLastPage()}} </strong>, 
  		Items per page:<strong> {{$elevi->getPerPage()}} </strong>, 
  		Total items:<strong> {{$elevi->getTotal()}} </strong>, 
  		From <strong> {{$elevi->getFrom()}} </strong> 
  		To <strong> {{$elevi->getTo()}} </strong>, 
  		Count: <strong> {{$elevi->count()}} </strong>.
  		</p>
  		<div class="alert alert-info" role="alert">
  			<a href="{{URL::route('add-new-elev')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Add New Elev"> <span class="glyphicon glyphicon-plus-sign"></span></a>
  		</div>
  <!-- Table -->
  <div class="table-responsive">
  	<table class="table table-hover table-condensed table-striped">

	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Nume</th>
      <th>Prenume</th>
      <th>Data nasterii</th>
      <th>Genul</th>
			<th>Created at</th>
			<th>Updated at</th>
			<th class="text-center">Actions</th>
		</tr>
	</thead>

<tbody>
	@foreach($elevi as $i => $elev)
        <tr>
          <td>{{ $i+1 }}.</td>
          <td>{{ $elev->id }}</td>
          <td>{{ $elev->nume}}</td>
          <td>{{ $elev->prenume}}</td>
          <td>{{ $elev->{"data nasterii"} }}</td>
          <td>{{ $elev->genul}}</td>
          <td>{{ $elev->created_at}}</td>
          <td>{{ $elev->updated_at}}</td>
          <td class="text-center">
          	<a href="#" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit this elev ({{ $elev->id }})"> <span class="glyphicon glyphicon-pencil"></span></a>
          	<a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete this elev ({{ $elev->id }})"> <span class="glyphicon glyphicon-trash"></span></a>
          </td>
        </tr>
    @endforeach   
      </tbody>


  	</table>
  </div>  
  </div>


<div class="panel-footer text-center">{{ $elevi->links() }}</div>
  

</div>

@stop

@section('js')
<script> 
	$('a').tooltip();
</script>
@stop