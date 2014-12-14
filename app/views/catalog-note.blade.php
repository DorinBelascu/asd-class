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


<?php 
    $starea = [ '-' => '[Selectati starea]', 'publica' => 'publica', 'privata' => 'privata'];
?>  
<!-- Modal -->
    <div class="modal fade" id="edit-{{ $elev->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myLargeModalLabel">Editeaza nota {{ $nota->valoare }} elevului {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie->denumirea}}</h4>
                </div>
                {{ Form::open(['url'=> URL::route('edit-nota', ['denumirea'=>$materie->denumirea, 'id' => $elev->id]), 'class' => 'form']) }}
                {{ Form::hidden('id', $nota->id)}}
                {{ Form::hidden('id_elev', $elev->id)}}
                {{ Form::hidden('denumirea', $materie->denumirea)}}
                {{ Form::hidden('id_materie', $materie->id)}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::text('nota', null , array('class'=>'form-control', 'placeholder' => "Adauga o nota intre 1 si 10")) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::input('date', 'data', null, array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data notei")) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            {{ Form::select('starea', $starea, Input::old('Starea Notei') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Starea Notei", ))}}
                        </div>
                    </div>
                    <span id="error-denumire" class="error-message"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    {{ Form::submit('Editeaza', array('id' =>'btn-add', 'class' => "btn btn-success")) }}       
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
