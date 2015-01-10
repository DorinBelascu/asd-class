@extends('layout')

@section('content')
<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Elevi <span class="badge pull-right"> {{ $note->getTotal() }}</span> </div>
  

  <div class="panel-body">
  	  	<p> 
  		Current page:<strong> {{$note->getCurrentPage()}} </strong>, 
  		Last page:<strong> {{$note->getLastPage()}} </strong>, 
  		Items per page:<strong> {{$note->getPerPage()}} </strong>, 
  		Total items:<strong> {{$note->getTotal()}} </strong>, 
  		From <strong> {{$note->getFrom()}} </strong> 
  		To <strong> {{$note->getTo()}} </strong>, 
  		Count: <strong> {{$note->count()}} </strong>.
  		</p>
  <!-- Table -->
  <div class="table-responsive">
  	<table class="table table-hover table-condensed table-striped">

	<thead>
		<tr>
			<th>#</th>
			<th><a href="{{URL::route('statistici-note')}}">Data</a></th>
      		<th><a href="{{URL::route('statistici-note') . '?sort=elev'}}">Elevul</a></th>
      		<th><a href="{{URL::route('statistici-note') . '?sort=materie'}}">Materia</a></th>
      		<th>Nota</th>
		</tr>
	</thead>

<tbody>
	<?php $j = $note->getFrom()-1 ?>
	@foreach($note as $i => $nota)
	<?php $j++ ?>
        <tr>
          <td>{{ $j }}.</td>
          <td>{{ $nota->data}}</td>
          <td>{{ $nota->elev->nume . ' ' . $nota->elev->prenume }}</td>
          <td>{{ $nota->materie->denumirea}}</td>
          <td>{{ $nota->valoare}}</td>
        </tr>
    @endforeach   
      </tbody>
  	</table>
  </div>  
  </div>
<div class="panel-footer text-center">{{ $note->links() }}</div>
</div>
@stop