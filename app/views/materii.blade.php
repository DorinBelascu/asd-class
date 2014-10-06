@extends('layout')

@section('content')

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Materii <span class="badge pull-right"> {{ $materii->getTotal() }}</span> </div>
  

  <div class="panel-body">
  	  	<p> 
  		Current page:<strong> {{$materii->getCurrentPage()}} </strong>, 
  		Last page:<strong> {{$materii->getLastPage()}} </strong>, 
  		Items per page:<strong> {{$materii->getPerPage()}} </strong>, 
  		Total items:<strong> {{$materii->getTotal()}} </strong>, 
  		From <strong> {{$materii->getFrom()}} </strong> 
  		To <strong> {{$materii->getTo()}} </strong>, 
  		Count: <strong> {{$materii->count()}} </strong>.
  		</p>
  		<div class="alert alert-info" role="alert">
  			<a href="{{URL::route('add-new-materie')}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Add New Subject"> <span class="glyphicon glyphicon-plus-sign"></span></a>
  		</div>
  <!-- Table -->
  <div class="table-responsive">
  	<table class="table table-hover table-condensed table-striped">

	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Name</th>
			<th>Created at</th>
			<th>Updated at</th>
			<th class="text-center">Actions</th>
		</tr>
	</thead>

<tbody>
	@foreach($materii as $i => $materie)
        <tr>
          <td>{{ $i+1 }}.</td>
          <td>{{ $materie->id }}</td>
          <td>{{ $materie->denumirea}}</td>
          <td>{{ $materie->created_at}}</td>
          <td>{{ $materie->updated_at}}</td>
          <td class="text-center">
          	<a href="#" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit this subject ({{ $materie->id }})"> <span class="glyphicon glyphicon-pencil"></span></a>
          	<a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete this subject ({{ $materie->id }})"> <span class="glyphicon glyphicon-trash"></span></a>
          </td>
        </tr>
    @endforeach   
      </tbody>


  	</table>
  </div>  
  </div>


<div class="panel-footer text-center">{{ $materii->links() }}</div>
  

</div>

@stop

@section('js')
<script> 
	$('a').tooltip();
</script>
@stop