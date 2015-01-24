@extends('layout')

@section('content')
<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Elevi <span class="badge pull-right"> {{ $absente->getTotal() }}</span> </div>
  

  <div class="panel-body">
  	  	<p> 
  		Current page:<strong> {{$absente->getCurrentPage()}} </strong>, 
  		Last page:<strong> {{$absente->getLastPage()}} </strong>, 
  		Items per page:<strong> {{$absente->getPerPage()}} </strong>, 
  		Total items:<strong> {{$absente->getTotal()}} </strong>, 
  		From <strong> {{$absente->getFrom()}} </strong> 
  		To <strong> {{$absente->getTo()}} </strong>, 
  		Count: <strong> {{$absente->count()}} </strong>.
  		</p>
  <!-- Table -->
  <div class="table-responsive">
  	<table class="table table-hover table-condensed table-striped">

	<thead>
		<tr>
			<th>#</th>
			<th><a href="{{URL::route('statistici-absente')}}">Data</a></th>
      <th><a href="{{URL::route('statistici-absente') . '?sort=elev'}}">Elevul</a></th>
      <th><a href="{{URL::route('statistici-absente') . '?sort=materie'}}">Materia</a></th>
      <th>Starea</th>
      <th>Semestrul</th>
		</tr>
	</thead>

<tbody>
	<?php $j = $absente->getFrom()-1 ?>
	@foreach($absente as $i => $absenta)
	<?php $j++; 
    // var_dump($absenta); die();
    ?>

        <tr>
          <td>{{ $j }}.</td>
          <td>{{ $absenta->data}}</td>
          <td>{{ $absenta->elev->nume . ' ' . $absenta->elev->prenume }}</td>
          <td>{{ $absenta->materie->denumirea}}</td>
          @if ($absenta->stare == 0)
            <td>Nemotivata</td>
          @else
            <td>Motivata</td>
          @endif
          <td>{{ $absenta->semestru }}</td>
        </tr>
    @endforeach   
      </tbody>
  	</table>
  </div>  
  </div>
<div class="panel-footer text-center">{{ $absente->links() }}</div>
</div>
@stop