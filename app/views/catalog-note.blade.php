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
                      <!-- Modal -->

<div class="modal fade" id="delete-{{ $nota->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete nota ( {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie->denumirea}} )</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['url'=> URL::route('delete-nota'), 'class' => 'form']) }}
        {{ Form::hidden('id', $nota->id)}}
        {{ Form::hidden('id_elev', $elev->id)}}
        {{ Form::hidden('denumirea', $materie->denumirea)}}
        Esti sigur ca vrei sa stergi nota lui "{{ $elev->nume . ' ' . $elev->prenume }}"?
      </div>
      <div class="modal-footer">
        {{ Form::submit('Sterge Nota', array('class'=>'btn btn-danger')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>  
        {{ Form::close() }}
    </div>
  </div>
</div>



                  </td>
                </tr>
              @endif
            @endforeach   
            </tbody>
          </table>


           <!-- Modal -->




        </div>
</div>


@stop
