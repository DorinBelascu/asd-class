@extends('layout')

@section('content')

<div class="row">
@if ( Session::get('result-success'))
    <div class="alert alert-success" role="alert">{{Session::get('result-success')}}</div>
@elseif (Session::get('result-fail'))
    @if ($errors->has('nume-edit'))
            <div class="col-md-12 alert alert-danger">
                <span class="error-message" style="font-size:20px">{{ $errors->first('nume-edit') }}</span>
            </div>
    @endif

    @if ($errors->has('prenume-edit'))
            <div class="col-md-12 alert alert-danger">
                <span class="error-message" style="font-size:20px">{{ $errors->first('prenume-edit') }}</span>
            </div>
    @endif

    @if ($errors->has('data_nasterii-edit'))
            <div class="col-md-12 alert alert-danger">
                <span class="error-message" style="font-size:20px">{{ $errors->first('data_nasterii-edit') }}</span>
            </div>
    @endif
@endif
</div>

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Elevi <span class="badge pull-right"> {{ $elevi->getTotal() }}</span> </div>
  

  <div class="panel-body">
  	  	<p> 
  		Pagina curenta:<strong> {{$elevi->getCurrentPage()}} </strong>, 
  		Ultima pagina:<strong> {{$elevi->getLastPage()}} </strong>, 
  		Itemi pe pagina:<strong> {{$elevi->getPerPage()}} </strong>, 
  		Total itemi:<strong> {{$elevi->getTotal()}} </strong>, 
  		De la <strong> {{$elevi->getFrom()}} </strong> 
  		Pana la <strong> {{$elevi->getTo()}} </strong>, 
  		Numar: <strong> {{$elevi->count()}} </strong>.
  		</p>
      @if(User::canChange())
  		<div class="alert alert-info" role="alert">
  			<button class="btn btn-success" data-toggle="modal" rel="tooltip" data-placement="top" title="Adauga elev"  data-target="#myModal"> <span class="glyphicon glyphicon-plus-sign"></span></button>
  		</div>


      @include('elevi.adaugare')
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
      <th>Data nasterii</th>
      <th>Genul</th>
			<th>Creat la</th>
			<th>Modificat la</th>
      <th>User ID</th>
		</tr>
	</thead>

<tbody>
	@foreach($elevi as $i => $elev)
        <tr>
          <td>{{ $i+1 }}.</td>
          <td>{{ $elev->id }}</td>
          <td>{{ $elev->nume}}</td>
          <td>{{ $elev->prenume}}</td>
          <td>{{ $elev->{"data nasterii"} }}</td>
          <td>
              {{HTML::image('images/' . $elev->genul . '.png', $elev->genul, ['width' => '32px', 'title' => $elev->genul])}} 

          </td>
          <td>{{ $elev->created_at}}</td>
          <td>{{ $elev->updated_at}}</td>
          <td>{{ $elev->user_id}}</td>
          <td class="text-center">
            <a href="{{URL::route('elevi_photo',['id' => $elev->id])}}" class="btn btn-xs btn-success" rel="tooltip" title='Vezi elevul ({{ $elev->id }})'><span class="glyphicon glyphicon-info-sign"></span></a>
          @if(User::canChange())
          	<button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-target="#edit-{{ $elev->id }}" data-placement="top" title="Editeaza elevul ({{ $elev->id }})"> <span class="glyphicon glyphicon-pencil"></span></button>
            <button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $elev->id }}"" data-placement="top" title="Sterge elevul ({{ $elev->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
          @endif
          </td>
        </tr>
      @if(User::canChange())
        @include('elevi.edit')
        @include('elevi.delete')
      @endif
    @endforeach   
      </tbody>


  	</table>
  </div>  
  </div>


<div class="panel-footer text-center">{{ $elevi->links() }}</div>
  

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
    var genul = $('select[name="genul"]').val();
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
    if (genul == '-')
    {
      $('#error-genul').html('Completati genul!');
      error = true;
    }
    return !error;
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