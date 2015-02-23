@extends('layout')

@section('content')



<div class="row">
  @if ( Session::get('result-success'))
      <div class="col-md-12 alert alert-succes">
          <div class="alert alert-success" role="alert">{{Session::get('result-success')}}</div>
      </div>
  @elseif (Session::get('result-fail'))
      <div class="col-md-12 alert alert-danger">
          <span class="error-message" style="font-size:20px">                    
              @if ($errors->has('absenta'))
                  {{ $errors->first('absenta') }}
              @endif
          </span>
      </div>
  @endif
</div>

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Absentele lui {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie->denumirea}} </div>
  <div class="panel-body">
      <!-- Table -->
      <div class="alert alert-info" role="alert">
        <div class="row">
          <div class="col-md-1">
          @if( User::canChange() )
            <button class="btn btn-success" data-toggle="modal" rel="tooltip" data-placement="top" title="Adauga absenta noua"  data-target="#myModal"> <span class="glyphicon glyphicon-plus-sign"></span></button>
          @endif
          </div>
          <div class="col-md-6 col-md-offset-2" style="text-align:center">
            <div class="btn-group" role="group" aria-label="..." style="margin:auto">
              <a href="{{URL::route('catalog-absente', ['id_elev' => $elev->id, 'id_materia' => $materie->id, 'denumirea' => $materie->denumirea]) . '?semestrul=1'}}" class="btn btn-default" rel="tooltip" title='Afiseaza absentele din semestrul 1'>Semestrul 1</a>
              <a href="{{URL::route('catalog-absente', ['id_elev' => $elev->id, 'id_materia' => $materie->id, 'denumirea' => $materie->denumirea])}}" class="btn btn-default" rel="tooltip" title='Afiseaza absentele din ambele semestre'>Ambele Semestre</a>
              <a href="{{URL::route('catalog-absente', ['id_elev' => $elev->id, 'id_materia' => $materie->id, 'denumirea' => $materie->denumirea]) . '?semestrul=2'}}" class="btn btn-default" rel="tooltip" title='Afiseaza absentele din semestrul 2'>Semestrul 2</a>
            </div>
          </div>
        </div>
      </div>
      @include('absente-elevi.adaugare')
      <div class="table-responsive">
        <table class="table table-hover table-condensed table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Data</th>
              <th>Tip</th>
              @if((User::canChange()) || ($user_este_elev ))
              <th>Stare</th>
              @endif
              <th class="text-center">Semestrul</th>
              <th>Creat la</th>
              <th>Modificat la</th>
            </tr>
          </thead>
          <tbody>
            <?php $j=0 ?>
            @foreach($absente as $i => $absenta)
              @if ($sem == 0)
                <tr>
                  <td>{{ $i+1 }}.</td>
                  <td>{{ $absenta->data}}</td>
                      <td>
                    {{ HTML::image('images/motivation/' . $absenta->stare . '.png','', ['style'=>'width:24px', 'title' => $absenta->stare ? 'motivata' : 'nemotivata'] ) }}
                    </td>
                    @if((User::canChange()) || ($user_este_elev ))
                    <!-- coloana cu public sau nu -->
                      <td class="text-center" style="width:32px">
                    {{ HTML::image('images/status/' . $absenta->publica_sau_nu . '.png','', ['style'=>'width:24px', 'title' => $absenta->publica_sau_nu ? 'publica' : 'privata', 'class' => 'stare_absenta', 'data-id' => $absenta->id, 'data-stare' => $absenta->publica_sau_nu] ) }}
                    </td>
                    @endif
                  <td class="text-center">{{ $absenta->semestru }}</td>
                  <td>{{ $absenta->created_at}}</td>
                  <td>{{ $absenta->updated_at}}</td>
                  @if(User::canChange())
                  <td class="text-center">
                      <button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-target="#edit-{{ $absenta->id }}" data-placement="top" title="Editeaza absenta ({{ $absenta->id }})"> <span class="glyphicon glyphicon-pencil"></span></button>
                      @include('absente-elevi.edit')
                      <button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $absenta->id }}" data-placement="top" title="Sterge absenta ({{ $absenta->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
                      @include('absente-elevi.delete')
                  </td>
                  @endif
                </tr>
              @elseif ($sem == $absenta->semestru)
                <tr>
                  <td>{{ ++$j }}.</td>
                  <td>{{ $absenta->data}}</td>
                  <td>
                  {{ HTML::image('images/motivation/' . $absenta->stare . '.png','', ['style'=>'width:24px', 'title' => $absenta->stare ? 'motivata' : 'nemotivata'] ) }}
                  </td>
                  <!-- coloana cu public sau nu -->
                  @if((User::canChange()) || ( $user_este_elev ))
                  <td class="text-center" style="width:32px">
                  {{ HTML::image('images/status/' . $absenta->publica_sau_nu . '.png','', ['style'=>'width:24px', 'title' => $absenta->publica_sau_nu ? 'publica' : 'privata', 'class' => 'stare_absenta', 'data-id' => $absenta->id, 'data-stare' => $absenta->publica_sau_nu] ) }}
                  </td>
                  @endif
                  <td class="text-center">{{ $absenta->semestru }}</td>
                  <td>{{ $absenta->created_at}}</td>
                  <td>{{ $absenta->updated_at}}</td>
                  <td class="text-center">
                      <button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-target="#edit-{{ $absenta->id }}" data-placement="top" title="Editeaza absenta ({{ $absenta->id }})"> <span class="glyphicon glyphicon-pencil"></span></button>
                      @include('absente-elevi.edit')
                      <button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $absenta->id }}" data-placement="top" title="Sterge absenta ({{ $absenta->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
                      @include('absente-elevi.delete')
                  </td>
                </tr>
              @endif
            @endforeach   
            </tbody>
          </table>
        </div>
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
    var data = $('input[name="data"]').val();
    var motivata_sau_nemotivata = $('select[name="motivata_sau_nemotivata"]').val();
    var publica_sau_nu = $('select[name="publica_sau_nu"]').val();
    var semestrul = $('select[name="semestrul"]').val();
    var error = false;
    $('span.error-message').html('');
    if (data.length != 10)
    {
      $('#error-data').html('Completati data!');
      error = true;
    }
    if (motivata_sau_nemotivata == '-')
    {
      $('#error-motivata_sau_nemotivata').html('Completati starea!');
      error = true;
    }
    if (publica_sau_nu == '-')
    {
      $('#error-publica_sau_nu').html('Completati campul!');
      error = true;
    }
    if (semestrul == '-')
    {
      $('#error-semestrul').html('Completati semestrul!');
      error = true;
    }
    return !error;
  });
  $('#btn-edit').click(function(e){
    var data_edit = $('input[name="data-edit"]').val();
    var error = false;
    $('span.error-message').html('');
    if (data_edit.length != 10)
    {
      $('#error-data-edit').html('Completati data!');
      error = true;
    }
    return !error;
  });

@if((User::canChange()) || ( $user_este_elev ))
  $(document).on('click', '.stare_absenta', function(){

    var id = $(this).attr('data-id');
    var stare = $(this).attr('data-stare');
    var row = $(this).parent().parent();

    $.ajax({
      'url'  : "{{URL::route('schimba-stare-absenta')}}",
      'type' : 'post',
      'data' : {'id' : id, 'stare' : stare},
      'success' : function(response){
          row.find('td:nth-child(4)').html(response);
      },
      'error' : function(error){
        console.log(error);
      }
    });
  });
@endif
</script>

@stop