@extends('layout')

@section('content')

<div class="row">
@if(Session::has('result-success'))
  <div class="alert alert-success col-md-12" role="alert">{{Session::get('result-success')}}</div>
@endif
</div>


<div class="row">
	<div class="col-md-8">
		<table class="table table-hover">
            <tr><th>Nume</th><td>{{$profesor->nume}}</td></tr>
            <tr><th>Prenume</th><td>{{$profesor->prenume}}</td></tr>
            <tr><th>Data nasterii</th><td>{{$profesor->{'data nasterii'} }}</td></tr>
        </table>

        <div class="panel panel-primary">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Materiile Profesorului <span style="font-weight: bold;">{{ $profesor->nume . ' ' . $profesor->prenume }}</span> <span class="badge pull-right"> {{ count($materii) }}</span> </div>
		  
		  <div class="panel-body">
		  	<div class="alert alert-info" role="alert">
		  		@if( count($lista) )
		  			<button class="btn btn-success" data-toggle="modal" rel="tooltip" data-placement="top" title="Add New Subject To {{ $profesor->nume . ' ' . $profesor->prenume }}"  data-target="#myModal"> <span class="glyphicon glyphicon-plus-sign"></span></button>
		  		@endif
		  	</div>

		  	@include('profesori.materii.adaugare')

		  <!-- Table -->
		  <div class="table-responsive">
		  	<table class="table table-hover table-condensed table-striped">

			<thead>
				<tr>
					<th>#</th>
					<th>Materie ID</th>
					<th>Name</th>
					<th>Created at</th>
					<th>Updated at</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>

			<tbody>
			@foreach($materii as $i => $pm)
				
			    <tr>
			      <td>{{ $i+1 }}</td>
			      <td>{{ $pm->id }}</td>
			      <td>{{ $pm->denumirea}}</td>
			      <td>{{ $pm->created_at}}</td>
			      <td>{{ $pm->updated_at}}</td>
			      <td class="text-center">
		          	<button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $pm->id }}"" data-placement="top" title="Delete this materie ({{ $pm->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
		          </td>
			    </tr>

			    @include('profesori.materii.delete')
		    
		 	@endforeach
			</tbody>


		  	</table>
		  </div>  
		  </div>  

		</div>
	</div>

	<div class="col-md-4">
		<div class="row">
            <div class="col-md-12">
                <div style="width: 240px; text-align:center; margin:0px auto">
                  {{ HTML::image('images/photos/profesori/' . str_replace('(-)', 'medium', $profesor->photo), $profesor->photo,['class' => 'img-responsive', 'style' => 'width:100%']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                
				<div style="width: 240px; text-align:center; margin:0px auto;">
					<div class="fileinput fileinput-new" data-provides="fileinput">
						<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 240px; height: 240px;">
						</div>

						<div>
							<span class="btn btn-default btn-file">
  								<span class="fileinput-new">Select image</span>
  								<span class="fileinput-exists">Change</span>
  								<input type="file" name="photo-elev" />
							</span>
							<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
							<button class="btn btn-default fileinput-exists"> Upload </button>
						</div>

					</div>
				</div>
			</div>
        </div>
	</div>
</div>




















@stop

@section('js')
<script>
  $('a').tooltip();
  $('button').tooltip();
  $('select').tooltip();
 </script>

@stop