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
              @if ($errors->has('nota'))
                  {{ $errors->first('nota') }}
              @endif
          </span>
      </div>
  @endif
</div>

<?php

$exista_teza1 = 0;
$exista_teza2 = 0;
foreach ($note as $i => $nota)
{
  if (($nota->teza == 1) && ($nota->semestru == 1)) 
  {
     $exista_teza1 = 1;
  }
  if (($nota->teza == 1) && ($nota->semestru == 2)) 
  {
     $exista_teza2 = 1;
  }
}
?>

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Notele lui {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie->denumirea}} </div>
    <div class="panel-body">
      <div class="alert alert-info" role="alert">
        <div class="row">
          <div class="col-md-1">
          @if(User::canChange())
            <button class="btn btn-success" data-toggle="modal" rel="tooltip" data-placement="top" title="Adauga o nota la {{$materie->denumirea}}" data-target="#myModal"> <span class="glyphicon glyphicon-plus-sign"></span></button>
          @endif
          </div>
          <div class="col-md-6 col-md-offset-2" style="text-align:center">
            <div class="btn-group" role="group" aria-label="..." style="margin:auto">
              <a href="{{URL::route('catalog-note', ['id_elev' => $elev->id, 'id_materia' => $materie->id, 'denumirea' => $materie->denumirea]) . '?semestrul=1'}}" class="btn btn-default" rel="tooltip" title='Afiseaza notele din semestrul 1'>Semestrul 1</a>
              <a href="{{URL::route('catalog-note', ['id_elev' => $elev->id, 'id_materia' => $materie->id, 'denumirea' => $materie->denumirea])}}" class="btn btn-default" rel="tooltip" title='Afiseaza notele din ambele semestre'>Ambele Semestre</a>
              <a href="{{URL::route('catalog-note', ['id_elev' => $elev->id, 'id_materia' => $materie->id, 'denumirea' => $materie->denumirea]) . '?semestrul=2'}}" class="btn btn-default" rel="tooltip" title='Afiseaza notele din semestrul 2'>Semestrul 2</a>
            </div>
          </div>
          <div class="col-md-1 col-md-offset-2">
            @if( (($exista_teza1 == 0) || ($exista_teza2 == 0)) && (User::canChange())) 
            <button class="btn btn-warning pull-right" data-toggle="modal" rel="tooltip" data-placement="top" title="Adauga teza la {{$materie->denumirea}}" data-target="#myModal2"> <span class="glyphicon glyphicon-plus-sign"></span></button>
            @endif
          </div>
        </div>
      </div>
          @if(User::canChange())
            @include('note-elevi.adaugare')
            @include('note-elevi.adaugare-teza')
          @endif
      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-hover table-condensed table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Valoare</th>
              @if((User::canChange()) || ( $user_este_elev ))
              <th>Stare</th>
              @endif
              <th>Data</th>
              <th>Tip</th>
              <th>Semestrul</th>
              <th>Creat la</th>
              <th>Modificat la</th>
            </tr>
          </thead>
          <tbody>
            <?php $j=0 ?>
            @foreach($note as $i => $nota)
              @if ($sem == 0)
                <tr>
                  <td>{{ ++$j }}/{{$nota->id}}.</td>
                  <td>{{ $nota->valoare }}</td>
                  @if((User::canChange()) || ( $user_este_elev ))
                  <td class="text-center" style="width:32px">
                     {{ HTML::image('images/status/' . $nota->publica_sau_nu . '.png','', ['style'=>'width:24px', 'title' => $nota->publica_sau_nu ? 'publica (Apasa pentru a schimba)' : 'privata (Apasa pentru a schimba)', 'class' => 'stare_nota', 'data-id' => $nota->id, 'data-stare' => $nota->publica_sau_nu] ) }}
                  </td> 
                  @endif  
                  <td>{{ $nota->data }}</td>
                   @if ($nota->teza == 0)
                      <td> Nota </td> 
                  @else
                      <td> Teza </td>
                  @endif  
                  <td>{{ $nota->semestru }}</td>
                  <td>{{ $nota->created_at }}</td>
                  <td>{{ $nota->updated_at }}</td>
                  @if(User::canChange())
                    <td class="text-center">
                        <!-- Modal -->
                        <button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-target="#edit-{{ $nota->id }}" data-placement="top" title="Editeaza nota ({{ $nota->id }})"> <span class="glyphicon glyphicon-pencil"></span></button>
                        @include('note-elevi.edit')
                        <button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $nota->id }}" data-placement="top" title="Sterge nota ({{ $nota->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
                        @include('note-elevi.delete')
                    </td>
                  @endif
                </tr>
              @elseif ($sem == $nota->semestru)
                <tr>
                  <td>{{ ++$j }}/{{$nota->id}}.</td>
                  <td>{{ $nota->valoare }}</td>
                  @if((User::canChange()) || ( $user_este_elev ))
                  <td class="text-center" style="width:32px">
                     {{ HTML::image('images/status/' . $nota->publica_sau_nu . '.png','', ['style'=>'width:24px', 'title' => $nota->publica_sau_nu ? 'publica (Apasa pentru a schimba)' : 'privata (Apasa pentru a schimba)', 'class' => 'stare_nota', 'data-id' => $nota->id, 'data-stare' => $nota->publica_sau_nu] ) }}
                  </td>    
                  @endif
                  <td>{{ $nota->data }}</td>
                   @if ($nota->teza == 0)
                      <td> Nota </td> 
                  @else
                      <td> Teza </td>
                  @endif  
                  <td>{{ $nota->semestru }}</td>
                  <td>{{ $nota->created_at }}</td>
                  <td>{{ $nota->updated_at }}</td>
                     @if(User::canChange())                  
                      <td class="text-center">
                          <!-- Modal -->
                          <button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-target="#edit-{{ $nota->id }}" data-placement="top" title="Editeaza nota ({{ $nota->id }})"> <span class="glyphicon glyphicon-pencil"></span></button>
                          @include('note-elevi.edit')
                          <button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $nota->id }}" data-placement="top" title="Sterge nota ({{ $nota->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
                          @include('note-elevi.delete')
                      </td>
                    @endif
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

function validare()
{
  var data    = $('input[name="data"]').val();
  var nota    = $('select[name="nota"').val();
  var starea  = $('select[name="starea"]').val();
  var sem     = $('select[name="semestrul"]').val();
  var error = false;
  $('span.error-message').html('');
  if (data.length != 10)
  {
    $('#error-data-adaugare').html('Completati data!');
    error = true;
  }
  if (nota == '-')
  {
    $('#error-nota-adaugare').html('Completati nota!');
    error = true;
  }
  if (starea == '-')
  {
    $('#error-starea-adaugare').html('Completati starea!');
    error = true;
  }
  if (sem == '-')
  {
    $('#error-semestrul-adaugare').html('Completati semestrul!');
    error = true;
  }
  return !error;
}

function validareTeza()
{
  var data    = $('input[name="data-teza"]').val();
  var nota    = $('select[name="nota-teza"]').val();
  var starea  = $('select[name="starea-teza"]').val();
  var sem     = $('select[name="semestrul-teza"]').val();
  var error = false;
  $('span.error-message').html('');
  if (data.length != 10)
  {
    $('#error-data-teza-adaugare').html('Completati data!');
    error = true;
  }
  if (nota == '-')
  {
    $('#error-nota-teza-adaugare').html('Completati nota!');
    error = true;
  }
  if (starea == '-')
  {
    $('#error-starea-teza-adaugare').html('Completati starea!');
    error = true;
  }
  if (sem == '-')
  {
    $('#error-semestrul-teza-adaugare').html('Completati semestrul!');
    error = true;
  }
  return !error;
}

function validareEditare()
{
    var data      = $('input[name="data-edit"]').val();
    var nota      = $('select[name="nota-edit"').val();
    var starea    = $('select[name="starea-edit"]').val();
    var semestrul = $ ('select[name="semestru-edit"]').val();
    var error     = false;

    $('span.error-message').html('');
    if (data.length != 10)
    {
        $('#error-data-edit').html('Completati data!');
        error = true;
    }
    if (nota == '-')
    {
        $('#error-nota-edit').html('Completati nota!');
        error = true;
    }
    if (starea == '-')
    {
        $('#error-starea-edit').html('Completati starea!');
        error = true;
    }
    if (semestrul == '-')
    {
        $('#error-semestru-edit').html('Completati semestrul!');
        error = true;
    }
    return !error;
}

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

  $('#btn-add-nota').click(function(e){
    return validare();
  });

  $('#btn-add-teza').click(function(e){
    return validareTeza();
  });


  $('#btn-edit').click(function(e){
    return validareEditare();
    // alert('Yesss...');
  });

@if((User::canChange()) || ( $user_este_elev ))
  $(document).on('click', '.stare_nota', function(){

    var id = $(this).attr('data-id');
    var stare = $(this).attr('data-stare');
    var row = $(this).parent().parent();

    $.ajax({
      'url'  : "{{URL::route('schimba-stare-nota')}}",
      'type' : 'post',
      'data' : {'id' : id, 'stare' : stare},
      'success' : function(response){
          row.find('td:nth-child(3)').html(response);
      },
      'error' : function(error){
        console.log(error);
      }
    });
  });
@endif


</script>
@stop