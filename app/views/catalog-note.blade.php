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


<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Notele lui {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie->denumirea}} </div>
    <div class="panel-body">
      <div class="alert alert-info" role="alert">
        <button class="btn btn-success" data-toggle="modal" rel="tooltip" data-placement="top" title="Add New Subject"  data-target="#myModal"> <span class="glyphicon glyphicon-plus-sign"></span></button>
      </div>
          @include('note-elevi.adaugare')
      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-hover table-condensed table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Valoare</th>
              <th>Publica sau nu</th>
              <th>Data</th>
              <th>Created at</th>
              <th>Updated at</th>
            </tr>
          </thead>
          <tbody>
            @foreach($note as $i => $nota)
              @if (($elev->id == $nota->elev_id) && ($materie->id == $nota->materie_id))
                <tr>
                  <td>{{ $i+1 }}.</td>
                  <td>{{ $nota->valoare }}</td>
                  @if ($nota->publica_sau_nu == 0)
                      <td> Privata </td> 
                  @else
                      <td> Publica </td>
                  @endif    
                  <td>{{ $nota->data}}</td>
                  <td>{{ $nota->created_at}}</td>
                  <td>{{ $nota->updated_at}}</td>
                  <td class="text-center">
                      <!-- Modal -->
                      <button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $nota->id }}" data-placement="top" title="Delete this subject({{ $nota->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
                      @include('note-elevi.delete')
                      <button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-target="#edit-{{ $elev->id }}" data-placement="top" title="Edit this nota({{ $nota->id }})"> <span class="glyphicon glyphicon-pencil"></span></button>
                      @include('note-elevi.edit')
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


function validare()
{
  var data    = $('input[name="data"]').val();
    var nota = $('input[name="nota"').val();
    var starea  = $('select[name="starea"]').val();
var error = false;
    $('span.error-message').html('');
    if (data.length != 10)
    {
      $('#error-data').html('Completati data!');
      error = true;
    }
    if (nota.length == 0)
    {
      $('#error-nota').html('Completati nota!');
      error = true;
    }
    if (starea == '-')
    {
      $('#error-starea').html('Completati starea!');
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
  $('#btn-edit').click(function(e){
    return validare();
  });
</script>
@stop