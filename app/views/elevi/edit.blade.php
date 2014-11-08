<?php 
    $gen = array('1' => 'masculin', '2' => 'feminin');
?>  
  <!-- Modal -->
<div class="modal fade" id="edit-{{ $elev->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit elev ( {{ $elev->id }} ) </h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['url'=> URL::route('edit-elev'), 'class' => 'form']) }}
        <div class="row">
          <div class="col-md-6">
            {{ Form::text('nume-edit', $elev->nume, array('class'=>'form-control', 'placeholder' => "Numele elevului")) }}
            {{ Form::hidden('id', $elev->id)}}
            <span id="error-nume-editare" class="error-message"></span>
          @if ($errors->has('nume'))
            <span class="error-message">{{ $errors->first('nume') }}</span>
          @endif
          </div>
          <div class="col-md-6">
            {{ Form::text('prenume-edit', $elev->prenume, array('class'=>'form-control', 'placeholder' => "Prenumele elevului")) }}
            <span id="error-prenume-editare" class="error-message"></span>
            @if ($errors->has('prenume'))
              <span class="error-message">{{ $errors->first('prenume') }}</span>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            {{ Form::input('date', 'data_nasterii-edit', $elev->{"data nasterii"}, array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data nasterii a elevului")) }}
            <span id="error-data_nasterii-editare" class="error-message"></span>
            @if ($errors->has('data_nasterii'))
              <span class="error-message">{{ $errors->first('data_nasterii') }}</span>
            @endif
          </div>
          <div class="col-md-6">
            {{ Form::select('genul', $gen, Input::old('Genul Elevului') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Genul elevului"))}}
          </div>  
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::submit('Editeaza Elev', array('class'=>'btn btn-success', 'id'=>'btn-edit')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
