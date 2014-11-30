@extends('layout')

@section('content')

<div class="panel panel-primary">
  <div class="panel-heading">Selecteaza un elev din catalog</div>
  <div class="panel-body">

  	<div>
  	@foreach($elevi as $i => $elev)
	  @if ($i % 4)
	  	<div class="col-md-3">
		        <div style="width: 240px; text-align:center; margin:0px auto">

		        	<a href="#">
		        	<div class="elev">
		        		<div class="afisare">
		          			{{ HTML::image('images/photos/elevi/' . $elev->photo, $elev->photo,['class' => 'img-responsive']) }}   
		          			<div class="sablon">
		          				<div class="nume_elev">                   
		          					{{ $elev->nume . ' ' . $elev->prenume }} 
		          				</div>        
		          			</div>     
		          		</div> 
		          	</div>
		          	</a>

		        </div>
		</div>
	  @else
	  	</div>
	  	<div class="row">
	  		<div class="col-md-3">
		        <div style="width: 240px; text-align:center; margin:0px auto">

		        	<a href="#">
		        	<div class="elev">
		        		<div class="afisare">
		          	{{ HTML::image('images/photos/elevi/' . $elev->photo, $elev->photo,['class' => 'img-responsive']) }}   
		          			<div class="sablon">
		          				<div class="nume_elev">                   
		          					{{ $elev->nume . ' ' . $elev->prenume }} 
		          				</div>     
		          			</div>     
		          		</div> 
		          	</div>
		         	</a>

		        </div>
			</div>

	  @endif
	@endforeach
	</div>

  </div>
</div>

@stop