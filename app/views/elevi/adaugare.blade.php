<?php 
    $gen = array( '-' => '[Selectati genul]', 'masculin' => 'masculin', 'feminin' => 'feminin');
    $users = array('-' => '[Selectati userul]', '1' => 'user1', '2' => 'user2')
?>  
  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add new elev</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['url'=> URL::route('add-new-elev'), 'class' => 'form']) }}
        <div class="row">
          <div class="col-md-6">
            {{ Form::text('nume', null, array('class'=>'form-control', 'placeholder' => "Numele elevului")) }}
            <span id="error-nume" class="error-message"></span>
          @if ($errors->has('nume'))
            <span class="error-message">{{ $errors->first('nume') }}</span>
          @endif
          </div>
          <div class="col-md-6">
            {{ Form::text('prenume', null, array('class'=>'form-control', 'placeholder' => "Prenumele elevului")) }}
            <span id="error-prenume" class="error-message"></span>
            @if ($errors->has('prenume'))
              <span class="error-message">{{ $errors->first('prenume') }}</span>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            {{ Form::input('date', 'data_nasterii', null, array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data nasterii a elevului")) }}
            <span id="error-data_nasterii" class="error-message"></span>
            @if ($errors->has('data_nasterii'))
              <span class="error-message">{{ $errors->first('data_nasterii') }}</span>
            @endif
          </div>
          <div class="col-md-6">
            {{ Form::select('genul', $gen, Input::old('Genul Elevului') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Genul elevului", ))}}
            <span id="error-genul" class="error-message"></span>
          </div>  
        </div>
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-4">
            {{ Form::select('user', $users, Input::old('Care user?') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Alege userul", ))}}
            <span id="error-user" class="error-message"></span>
          </div>
          <div class="col-md-4">
          </div>  
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::submit('Adauga Elev', array('class'=>'btn btn-success', 'id'=>'btn-add')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
