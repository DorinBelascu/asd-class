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
        <button class="btn btn-success" data-toggle="modal" rel="tooltip" data-placement="top" title="Add New Subject"  data-target="#myModal"> <span class="glyphicon glyphicon-plus-sign"></span></button>
      </div>
      @include('absente-elevi.adaugare')
      <div class="table-responsive">
        <table class="table table-hover table-condensed table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Data</th>
              <th>Stare</th>
              <th>Publica sau Privata </th>
              <th>Semestrul</th>
              <th>Created at</th>
              <th>Updated at</th>
            </tr>
          </thead>
          <tbody>
            @foreach($absente as $i => $absenta)
                <tr>
                  <td>{{ $i+1 }}.</td>
                  <td>{{ $absenta->data}}</td>
                    @if ($absenta->stare == 0)
                      <td> Nemotivata </td> 
                    @else
                      <td> Motivata </td>
                    @endif
                    @if ($absenta->publica_sau_nu == 0)
                      <td> privata </td> 
                    @else
                      <td> publica </td>
                    @endif
                  </td>
                  <td>{{ $absenta->semestru }}</td>
                  <td>{{ $absenta->created_at}}</td>
                  <td>{{ $absenta->updated_at}}</td>
                  <td class="text-center">
                      <button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $absenta->id }}" data-placement="top" title="Delete this subject({{ $absenta->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
                      @include('absente-elevi.delete')
                      <button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-target="#edit-{{ $elev->id }}" data-placement="top" title="Edit this absenta({{ $absenta->id }})"> <span class="glyphicon glyphicon-pencil"></span></button>
                      @include('absente-elevi.edit')
                  </td>
                </tr>
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
</script>

@stop