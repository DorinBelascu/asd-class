
@extends('layout')

@section('content')

<div class="row">
@if(Session::has('result'))
  <div class="alert alert-danger col-md-12" role="alert">{{Session::get('result')}}</div>
@endif
</div>

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
  			<button class="btn btn-success" data-toggle="modal" rel="tooltip" data-target="#add-profesori" data-placement="top" title="Add New Profesor"> <span class="glyphicon glyphicon-plus-sign"></span>
        </button>
  		</div>

@include('profesori.adaugare')

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
            <a href="{{URL::route('profesor_materii',['id' => $profesor->id])}}" class="btn btn-xs btn-success" rel="tooltip" title='View this profesor ({{ $profesor->id }})'><span class="glyphicon glyphicon-info-sign"></span></a>
          	<button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-target="#edit-{{ $profesor->id }}" data-placement="top" title="Edit this profesor ({{ $profesor->id }})"> <span class="glyphicon glyphicon-pencil"></span></button>
          	<button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $profesor->id }}"" data-placement="top" title="Delete this profesor ({{ $profesor->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
          </td>
        </tr>

@include('profesori.edit')

@include('profesori.delete')

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
  $('button').tooltip();
  $('input').tooltip();
  $('input').keyup(function(){
    var val = $(this).val();
    if (val.length > 0)
    {
      $(this).parent().find('span.error-message').html('');
    }
    else
    {
      $(this).parent().find('span.error-message').html('Trebuie Completat');
    }
  });
  $('#btn-add').click(function(e){
    var nume = $('input[name="nume"]').val();
    var prenume = $('input[name="prenume"').val();
    var data_nasterii = $('input[name="data_nasterii"]').val();
    var error = false;
    $('span.error-message').html('');
    if (nume.length == 0)
    {
      $('#error-nume').html('Completati numele!');
      error = true;
    }
    if (prenume.length == 0)
    {
      $('#error-prenume').html('Completati prenumele!');
      error = true;
    }
    if (data_nasterii.length != 10)
    {
      $('#error-data_nasterii').html('Completati data nasterii!');
      error = true;
    }
    return ! error;
  });

  $('#btn-edit').click(function(e){
  var nume = $('input[name="nume-edit"]').val();
  var prenume = $('input[name="prenume-edit"').val();
  var data_nasterii = $('input[name="data_nasterii-edit"]').val();
  var error = false;
  $('span.error-message').html('');
  if (nume.length == 0)
  {
    $('#error-nume-editare').html('Completati numele!');
    error = true;
  }
  if (prenume.length == 0)
  {
    $('#error-prenume-editare').html('Completati prenumele!');
    error = true;
  }
  if (data_nasterii.length != 10)
  {
    $('#error-data_nasterii-editare').html('Completati data nasterii!');
    error = true;
  }
  return !error;
});
</script>
@stop