
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
  		  Pagina curenta:<strong> {{$profesori->getCurrentPage()}} </strong>, 
    		Ultima pagina:<strong> {{$profesori->getLastPage()}} </strong>, 
    		Itemi pe pagina:<strong> {{$profesori->getPerPage()}} </strong>, 
    		Total itemi:<strong> {{$profesori->getTotal()}} </strong>, 
    		De la <strong> {{$profesori->getFrom()}} </strong> 
    		Pana la <strong> {{$profesori->getTo()}} </strong>, 
    		Numar: <strong> {{$profesori->count()}} </strong>.
    	</p>
      <!-- butonul si formularul de adaugare -->
      @if( User::CanChange() )
    		<div class="alert alert-info" role="alert">
    			<button class="btn btn-success" data-toggle="modal" rel="tooltip" data-target="#add-profesori" data-placement="top" title="Adauga profesor"> <span class="glyphicon glyphicon-plus-sign"></span>
          </button>
    		</div>

        @include('profesori.adaugare')
      @endif
  <!-- Table -->
  <div class="table-responsive">
  	<table class="table table-hover table-condensed table-striped">

	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Nume</th>
			<th>Prenume</th>
      <th>Cate materii preda</th>
			<th>Data Nasterii</th>
			<th>Creat la</th>
			<th>Modificat la</th>
      <th>User ID</th>
		</tr>
	</thead>

<tbody>
	@foreach($profesori as $i => $profesor)
        <tr>
          <td>{{ $i+1 }}.</td>
          <td>{{ $profesor->id }}</td>
          <td>{{ $profesor->nume}}</td>
          <td>{{ $profesor->prenume}}</td>
          <td>{{ $cnt = $profesor->Profesorimaterii->count()}}
          <td>{{ $profesor->{"data nasterii"} }} </td>
          <td>{{ $profesor->created_at}}</td>
          <td>{{ $profesor->updated_at}}</td>
          <td>{{ $profesor->user_id}}</td>
          <td class="text-center">
            <a href="{{URL::route('profesor_materii',['id' => $profesor->id])}}" class="btn btn-xs btn-success" rel="tooltip" title='Vezi materiile predate de profesor ({{ $cnt }})'><span class="glyphicon glyphicon-info-sign"></span></a>
            @if( User::CanChange() )
            	<button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-target="#edit-{{ $profesor->id }}" data-placement="top" title="Editeaza profesorul ({{ $profesor->id }})"> <span class="
              glyphicon glyphicon-pencil"></span></button>
              @if($cnt == 0)
            	 <button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $profesor->id }}"" data-placement="top" title="Sterge profesorul ({{ $profesor->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
              @endif
            @endif
          </td>
        </tr>
@if(User::canChange())
  @include('profesori.edit')
  @include('profesori.delete')
@endif

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
  $('input').keyup(function(){
    var val = $(this).val();
    if (val.length > 0)
    {
      $(this).parent().find('span.error-message').html('');
    }
    else
    {
      $(this).parent().find('span.error-message').html('Trebuie Completat');
    }
  });
  $('#btn-add').click(function(e){
    var nume = $('input[name="nume"]').val();
    var prenume = $('input[name="prenume"').val();
    var data_nasterii = $('input[name="data_nasterii"]').val();
    var error = false;
    $('span.error-message').html('');
    if (nume.length == 0)
    {
      $('#error-nume').html('Completati numele!');
      error = true;
    }
    if (prenume.length == 0)
    {
      $('#error-prenume').html('Completati prenumele!');
      error = true;
    }
    if (data_nasterii.length != 10)
    {
      $('#error-data_nasterii').html('Completati data nasterii!');
      error = true;
    }
    return ! error;
  });

  $('#btn-edit').click(function(e){
  var nume = $('input[name="nume-edit"]').val();
  var prenume = $('input[name="prenume-edit"').val();
  var data_nasterii = $('input[name="data_nasterii-edit"]').val();
  var error = false;
  $('span.error-message').html('');
  if (nume.length == 0)
  {
    $('#error-nume-editare').html('Completati numele!');
    error = true;
  }
  if (prenume.length == 0)
  {
    $('#error-prenume-editare').html('Completati prenumele!');
    error = true;
  }
  if (data_nasterii.length != 10)
  {
    $('#error-data_nasterii-editare').html('Completati data nasterii!');
    error = true;
  }
  return !error;
});
</script>
@stop