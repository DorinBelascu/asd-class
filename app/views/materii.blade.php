@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if ($errors->has('add_materie'))
            <span class="error-message" style="font-size:20px">{{ $errors->first('add_materie') }}</span>
        @endif
    </div>
</div>    

@if ( Session::get('result'))
<div class="alert alert-success" role="alert">{{Session::get('result')}}</div>
@endif

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Materii <span class="badge pull-right"> {{ $materii->getTotal() }}</span> </div>
  

  <div class="panel-body">
  	  	<p> 
  		Current page:<strong> {{$materii->getCurrentPage()}} </strong>, 
  		Last page:<strong> {{$materii->getLastPage()}} </strong>, 
  		Items per page:<strong> {{$materii->getPerPage()}} </strong>, 
  		Total items:<strong> {{$materii->getTotal()}} </strong>, 
  		From <strong> {{$materii->getFrom()}} </strong> 
  		To <strong> {{$materii->getTo()}} </strong>, 
  		Count: <strong> {{$materii->count()}} </strong>.
  		</p>
  		<div class="alert alert-info" role="alert">
  			<button class="btn btn-success" data-toggle="modal" rel="tooltip" data-placement="top" title="Add New Subject"  data-target="#myModal"> <span class="glyphicon glyphicon-plus-sign"></span></button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myLargeModalLabel">Adauga materie 9</h4>
                        </div>
                        {{ Form::open(['url'=> URL::route('add-new-materie'), 'class' => 'form']) }}
                        <div class="modal-body">
                           {{ Form::text('add_materie', null, array('class'=>'form-control', 'placeholder' => "Denumirea")) }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            {{ Form::submit('Adauga', array('name' => "", 'class' => "btn btn-success")) }}       
                        </div>
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
			<th>Created at</th>
			<th>Updated at</th>
			<th class="text-center">Actions</th>
		</tr>
	</thead>

<tbody>
	@foreach($materii as $i => $materie)
        <tr>
          <td>{{ $i+1 }}.</td>
          <td>{{ $materie->id }}</td>
          <td>{{ $materie->denumirea}}</td>
          <td>{{ $materie->created_at}}</td>
          <td>{{ $materie->updated_at}}</td>
          <td class="text-center">


            <button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-placement="top" title="Edit this subject ({{ $materie->id }})" data-target="#Modal{{ $i }}"> <span class="glyphicon glyphicon-pencil"></span></button>
            <!-- Modal -->
            <div class="modal fade" id="Modal{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        </div>
                        {{ Form::open(['url'=> URL::route('add-new-materie'), 'class' => 'form']) }}
                        <div class="modal-body">
                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            {{ Form::submit('Adauga', array('name' => "", 'class' => "btn btn-success")) }}       
                        </div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>




          	<a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete this subject ({{ $materie->id }})"> <span class="glyphicon glyphicon-trash"></span></a>
          </td>
        </tr>
    @endforeach   
      </tbody>


  	</table>
  </div>  
  </div>


<div class="panel-footer text-center">{{ $materii->links() }}</div>
  

</div>

@stop

@section('js')
<script> 
	$('button').tooltip();
</script>
@stop