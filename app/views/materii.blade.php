@extends('layout')

@section('content') 

<div class="row">
  @if ( Session::get('result-success'))
    <div class="alert alert-success" role="alert">{{Session::get('result-success')}}</div>
  @elseif (Session::get('result-fail'))
    @if ($errors->has('add_materie'))
            <div class="col-md-12 alert alert-danger">
                <span class="error-message" style="font-size:20px">{{ $errors->first('add_materie') }}</span>
            </div>
    @endif
    @if ($errors->has('edit-materie'))
            <div class="col-md-12 alert alert-danger">
                <span class="error-message" style="font-size:20px">{{ $errors->first('edit-materie') }}</span>
            </div>
    @endif

@endif
</div>

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Materii <span class="badge pull-right"> {{ $materii->getTotal() }}</span> </div>
  

  <div class="panel-body">
  	  	<p> 
  		Pagina curenta:<strong> {{$materii->getCurrentPage()}} </strong>, 
  		Ultima pagina:<strong> {{$materii->getLastPage()}} </strong>, 
  		Itemi pe pagina:<strong> {{$materii->getPerPage()}} </strong>, 
  		Total itemi:<strong> {{$materii->getTotal()}} </strong>, 
  		De la <strong> {{$materii->getFrom()}} </strong> 
  		Pana la <strong> {{$materii->getTo()}} </strong>, 
  		Numar: <strong> {{$materii->count()}} </strong>.
  		</p>
      @if(User::canChange())
  		<div class="alert alert-info" role="alert">
  			<button class="btn btn-success" data-toggle="modal" rel="tooltip" data-placement="top" title="Adauga materie"  data-target="#myModal"> <span class="glyphicon glyphicon-plus-sign"></span></button>
      </div>
      @include('materii.adaugare')
      @endif
    <!-- Table -->
  <div class="table-responsive">
  	<table class="table table-hover table-condensed table-striped">

	<thead>
		<tr>
			<th>#</th>
			<th>ID</th>
			<th>Denumirea</th>
      <th>Numar Profesori</th>
			<th>Creat la</th>
			<th>Modificat la</th>
			<th class="text-center">Actions</th>
		</tr>
	</thead>

<tbody>
	@foreach($materii as $i => $materie)
        <tr>
          <td>{{ $i+1 }}.</td>
          <td>{{ $materie->id }}</td>
          <td>{{ $materie->denumirea}}</td>
          <td>{{ $cnt = $materie->Profesorimaterii->count()}}</td>
          <td>{{ $materie->created_at}}</td>
          <td>{{ $materie->updated_at}}</td>
          <td class="text-center">
            <a href="{{URL::route('materie_profesori',['id' => $materie->id])}}" class="btn btn-xs btn-success" rel="tooltip" title="Vezi profesorii care predau aceasta materie ({{ $cnt }})"><span class="glyphicon glyphicon-info-sign"></span></a>
            @if(User::canChange())
              <button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-placement="top" title="Editeaza materia ({{ $materie->id }})" data-target="#Modal{{ $i }}"> <span class="glyphicon glyphicon-pencil"></span></button>
              <!-- Modal -->
              @if($cnt == 0)
            	 <button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $materie->id }}"" data-placement="top" title="Sterge materia({{ $materie->id }})"> <span class="glyphicon glyphicon-trash"></span></button> 
              @endif
            @endif
            <!-- Modal -->
          </td>
        </tr>
  @if(User::canChange())
    @include('materii.edit')
    @include('materii.delete')
  @endif
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
      $(this).parent().find('span.error-message').html('Trebuie completata denumirea');
    }
  });
  $('#btn-add').click(function(e)
  {
    var nume = $('input[name="add_materie"]').val();
    var error = false;
    $('span.error-message').html('');
    if (nume.length == 0)
    {
      $('#error-denumire').html('Completati denumirea!');
      error = true;
    }
    return !error;
  });
  $('#btn-edit').click(function(e)
  {
    var denumire = $('input[name="edit-materie"]').val();
    var error = false;
    $('span.error-message').html('');
    if (denumire.length == 0)
    {
      $('#error-denumire-editare').html('Completati denumirea!');
      error = true;
    }
    return !error;
  });
</script>
@stop