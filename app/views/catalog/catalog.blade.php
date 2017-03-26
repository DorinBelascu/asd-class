@extends('layout')

@section('content')
<div class="panel panel-primary">
	<div class="panel-heading">Selecteaza un elev din catalog <span class="badge pull-right"> {{ count($elevi) }}</span></div>
  	<div class="panel-body">
		<div class="row">
		@foreach($elevi as $i => $elev)
			<div class="col-md-3 col-xs-6">
				<div style="text-align:center; margin:4px auto">
					<a href="{{ URL::route('materii-catalog', ['id' => $elev->id]) }}">
						<div class="elev">
							<div class="afisare">
								Clase
								 
							</div> 
						</div>
					</a>
				</div>
			</div>
		@endforeach
		</div>
  	</div>
</div>

@stop