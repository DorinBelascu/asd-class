@extends('layout')

@section('content')
<div class="row">
	<div class="col-md-8">
	<div class="panel panel-primary">
	  	<!-- Default panel contents -->
	  	<div class="panel-heading">Profesorii care predau <span style="font-weight: bold;">{{ $materie->denumirea }}</span> <span class="badge pull-right"> {{ $profesori->count() }}</span> </div>
			<div class="panel-body">
			@if(User::canChange())
				<div class="alert alert-info" role="alert">
			  		@if( count($lista) )
			  			<button class="btn btn-success" data-toggle="modal" rel="tooltip" data-placement="top" title="Adauga profesor la materia {{ $materie->denumirea }}"  data-target="#myModal"> <span class="glyphicon glyphicon-plus-sign"></span></button>
			  		@endif
	  			</div>
	  			@include('materii.profesori.adaugare')
	  		@endif
			  	<!-- Table -->
			  	<div class="table-responsive">
					<table class="table table-hover table-condensed table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Profesor ID</th>
								<th>Nume</th>
								<th>Prenume</th>
								<th>Data Nasterii</th>
								<th>Creat la</th>
								<th>Modificat la</th>
							</tr>
						</thead>
						<tbody>
						@foreach($profesori as $i => $pm)
							<tr>
							  <td>{{ $i+1 }}</td>
							  <td>{{ $pm->Profesor->id }}</td>
							  <td>{{ $pm->Profesor->nume}}</td>
							  <td>{{ $pm->Profesor->prenume}}</td>
							  <td>{{ $pm->Profesor->{"data nasterii"} }}</td>
							  <td>{{ $pm->Profesor->created_at}}</td>
							  <td>{{ $pm->Profesor->updated_at}}</td>
							  @if(User::canChange())
							  <td class="text-center">
				          			<button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $pm->id }}"" data-placement="top" title="Sterge profesorul ({{ $pm->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
				          		</td>
				          	   @endif
							</tr>
							@include('materii.profesori.delete')
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
                	@if($materie->photo)
                  {{ HTML::image('images/photos/materii/' . str_replace('(-)', 'icon', $materie->photo), $materie->photo,['class' => 'img-responsive', 'style' => 'width:100%']) }}
                  	@endif
                </div>
            </div>
        </div>
        @if(User::canChange())
        <div class="row">
            <div class="col-md-12">    
				<div style="width: 240px; text-align:center; margin:0px auto;">
					<div class="fileinput fileinput-new" data-provides="fileinput">
						<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 240px; height: 240px;">
						</div>
						{{ Form::open(['method'=>'post', 'files'=>true, 'url'=>URL::route('save-materie-photo-upload', ['id'=>$materie->id])])}}
						<div>
							<span class="btn btn-default btn-file">
  								<span class="fileinput-new">Selecteaza imaginea</span>
  								<span class="fileinput-exists">Schimba</span>
  								<input type="file" name="photo-materie" />
							</span>
							<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Sterge</a>
							<button class="btn btn-default fileinput-exists"> Incarca </button>
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
        </div>
        @endif
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