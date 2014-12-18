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
              <th>Created at</th>
              <th>Updated at</th>
            </tr>
          </thead>
          <tbody>
            @foreach($absente as $i => $absenta)
              @if (($elev->id == $absenta->elev_id) && ($materie->id == $absenta->materie_id))
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
                  <td>{{ $absenta->created_at}}</td>
                  <td>{{ $absenta->updated_at}}</td>
                  <td class="text-center">
                      <!-- Modal -->
                      <button class="btn btn-danger btn-xs" data-toggle="modal" rel="tooltip" data-target="#delete-{{ $absenta->id }}" data-placement="top" title="Delete this subject({{ $absenta->id }})"> <span class="glyphicon glyphicon-trash"></span></button>
                      @include('absente-elevi.delete')
                      <button class="btn btn-primary btn-xs" data-toggle="modal" rel="tooltip" data-target="#edit-{{ $elev->id }}" data-placement="top" title="Edit this absenta({{ $absenta->id }})"> <span class="glyphicon glyphicon-pencil"></span></button>



<?php 
    $motivata_sau_nemotivata = [ '-' => '[Selectati daca motivata sau nemotivata]', 'motivata' => 'motivata', 'nemotivata' => 'nemotivata'];
    $publica_sau_nu = ['-' => '[Selectati daca sa fie publica sau nu]', 'publica' => 'publica', 'privata' => 'privata'];
?>  
<!-- Modal -->
<div class="modal fade" id="edit-{{ $elev->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myLargeModalLabel">Editeasa absenta elevului {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie->denumirea}}</h4>
            </div>
            {{ Form::open(['url'=> URL::route('edit-absenta', ['denumirea'=>$materie->denumirea, 'id' => $elev->id]), 'class' => 'form']) }}
            {{ Form::hidden('id', $absenta->id)}}
            {{ Form::hidden('id_elev', $elev->id)}}
            {{ Form::hidden('denumirea', $materie->denumirea)}}
            {{ Form::hidden('id_materie', $materie->id)}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::input('date', 'data', $absenta->data, array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data notei")) }}
                        <span id="error-data" class="error-message"></span>
                    </div>
                    <div class="col-md-6">
                        {{ Form::select('motivata_sau_nemotivata', $motivata_sau_nemotivata, Input::old('Motivata sau nemotivata') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Daca sa fie motivata sau nemotivata", ))}}
                        <span id="error-nota" class="error-message"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-3 col-md-6">
                        {{ Form::select('publica_sau_nu', $publica_sau_nu, Input::old('Publica sau nu') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Publica sau nu", ))}}
                        <span id="error-starea" class="error-message"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                {{ Form::submit('Editeaza', array('id' =>'btn-add-nota', 'class' => "btn btn-success")) }}       
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
        </div>
</div>


@stop
