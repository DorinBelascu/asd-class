@extends('layout')

@section('content')
	
<div class="panel panel-primary">
  <!-- Default panel contents -->
  	<div class="panel-heading">Medii </div>
  	<div class="panel-body">
  		<!-- Table -->
	  	<div class="table-responsive">
	  		<table class="table table-hover table-condensed table-striped">

				<thead>
					<tr>
						<th>#</th>
					    <th><a href="{{URL::route('statistici-medii') . '?sort=elev'}}">Elevul</a></th>
					    <th><a href="{{URL::route('statistici-medii') . '?sort=medie1'}}">Medie Sem 1</a></th>
					   	<th><a href="{{URL::route('statistici-medii') . '?sort=medie2'}}">Medie Sem 2</a></th>
					   	<th><a href="{{URL::route('statistici-medii') . '?sort=medietot'}}">Medie Totala</a></th>
					</tr>
				</thead>

				<tbody>
					@foreach($medii as $i => $medie)
					    <tr>
					    	<td>{{ $i }}</td>
					      	<td>{{ $medie['NumePrenume'] }}</td>
					      	<td>{{ $medie['medie1'] }}</td>
				     	 	<td>{{ $medie['medie2']}}</td>
					      	<td>{{ $medie['medietot']}}</td>
						</tr>
					@endforeach   
		      	</tbody>
	  		</table>
	  	</div>  
  	</div>
	<div class="panel-footer text-center"></div>
</div>




@stop