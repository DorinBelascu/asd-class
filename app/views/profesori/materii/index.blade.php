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
		  @if(User::canChange())
		  	<div class="alert alert-info" role="alert">
		  		@if( count($lista) )
		  			<button class="btn btn-success" data-toggle="modal" rel="tooltip" data-placement="top" title="Adauga materie la profesorul {{ $profesor->nume . ' ' . $profesor->prenume }}"  data-target="#myModal"> <span class="glyphicon glyphicon-plus-sign"></span></button>
		  		@endif
		  	</div>
		  @endif

		  	@include('profesori.materii.adaugare')

		  <!-- Table -->
		  <div class="table-responsive">
		  	<table class="table table-hover table-condensed table-striped">

			<thead>
				<tr>
					<th>#</th>
					<th>Materie ID</th>
					<th>Dennumirea</th>
					<th>Creat la</th>
					<th>Modificat la</th>
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
			      @if(User::canChange())
			      <td class="text-center">
		          	<button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $pm->id }}"" data-placement="top" title="Sterge materia ({{ $pm->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
		          </td>
		          @endif
			    </tr>

			    @if(User::canChange())
			    	@include('profesori.materii.delete')
			    @endif
		    
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
    @if(User::canChange())
        <div class="row">
            <div class="col-md-12">
				<div style="width: 240px; text-align:center; margin:0px auto;">
					<div class="fileinput fileinput-new" data-provides="fileinput">
						<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 240px; height: 240px;">
						</div>
						{{ Form::open(['method'=>'post', 'files'=>true, 'url'=>URL::route('save-profesor-photo-upload', ['id'=>$profesor->id])])}}
						<div>
							<span class="btn btn-default btn-file">
  								<span class="fileinput-new">Selecteaza imaginea</span>
  								<span class="fileinput-exists">Schimba</span>
  								<input type="file" name="photo-profesor" />
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