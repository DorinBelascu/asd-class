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

  <!-- Modal -->
<div class="modal fade" id="add-profesori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add new profesor</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['url'=> URL::route('add-new-profesor'), 'class' => 'form']) }}
        <div class="row">
          <div class="col-md-6">
            {{ Form::text('nume', null, array('class'=>'form-control', 'placeholder' => "Numele profesorului")) }}
          @if ($errors->has('nume'))
            <span class="error-message">{{ $errors->first('nume') }}</span>
          @endif
          </div>
          <div class="col-md-6">
            {{ Form::text('prenume', null, array('class'=>'form-control', 'placeholder' => "Prenumele profesorului")) }}
            @if ($errors->has('prenume'))
              <span class="error-message">{{ $errors->first('prenume') }}</span>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-4">
            {{ Form::input('date', 'data_nasterii', null, array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data nasterii a profesorului")) }}
            @if ($errors->has('data_nasterii'))
              <span class="error-message">{{ $errors->first('data_nasterii') }}</span>
            @endif
          </div>
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::submit('Adauga Profesor', array('class'=>'btn btn-success')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         {{ Form::close() }}
      </div>
    </div>
  </div>
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
          	<button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-target="#edit-{{ $profesor->id }}" data-placement="top" title="Edit this profesor ({{ $profesor->id }})"> <span class="glyphicon glyphicon-pencil"></span></button>
          	<button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $profesor->id }}"" data-placement="top" title="Delete this profesor ({{ $profesor->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
          </td>
        </tr>

  <!-- Modal -->
<div class="modal fade" id="edit-{{ $profesor->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit profesor ( {{ $profesor->id }} )</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['url'=> URL::route('edit-profesor'), 'class' => 'form']) }}
        {{ Form::hidden('id', $profesor->id)}}
        <div class="row">
          <div class="col-md-6">
            {{ Form::text('nume', $profesor->nume, array('class'=>'form-control', 'placeholder' => "Numele profesorului")) }}
          @if ($errors->has('nume'))
            <span class="error-message">{{ $errors->first('nume') }}</span>
          @endif
          </div>
          <div class="col-md-6">
            {{ Form::text('prenume', $profesor->prenume, array('class'=>'form-control', 'placeholder' => "Prenumele profesorului")) }}
            @if ($errors->has('prenume'))
              <span class="error-message">{{ $errors->first('prenume') }}</span>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-4">
            {{ Form::input('date', 'data_nasterii', $profesor->{"data nasterii"}, array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data nasterii a profesorului")) }}
            @if ($errors->has('data_nasterii'))
              <span class="error-message">{{ $errors->first('data_nasterii') }}</span>
            @endif
          </div>
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::submit('Editeaza Profesor', array('class'=>'btn btn-primary')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         {{ Form::close() }}
      </div>
    </div>
  </div>
</div>


 <!-- Modal -->
<div class="modal fade" id="delete-{{ $profesor->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete profesor ( {{ $profesor->id }} )</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['url'=> URL::route('delete-profesor'), 'class' => 'form']) }}
        {{ Form::hidden('id', $profesor->id)}}
        Esti sigur ca vrei sa stergi profesorul "{{ $profesor->nume . ' ' . $profesor->prenume }}"?
      </div>
      <div class="modal-footer">
        {{ Form::submit('Sterge Profesor', array('class'=>'btn btn-danger')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         {{ Form::close() }}
      </div>
    </div>
  </div>
</div>

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
</script>
@stop