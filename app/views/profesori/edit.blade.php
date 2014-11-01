  <!-- Modal -->
<div class="modal fade" id="edit-{{ $profesor->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit profesor ( {{ $profesor->id }} )</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['url'=> URL::route('edit-profesor'), 'class' => 'form']) }}
        {{ Form::hidden('id', $profesor->id)}}
        <div class="row">
          <div class="col-md-6">
            {{ Form::text('nume', $profesor->nume, array('class'=>'form-control', 'placeholder' => "Numele profesorului")) }}
          @if ($errors->has('nume'))
            <span class="error-message">{{ $errors->first('nume') }}</span>
          @endif
          
          </div>
          <div class="col-md-6">
            {{ Form::text('prenume', $profesor->prenume, array('class'=>'form-control', 'placeholder' => "Prenumele profesorului")) }}
            @if ($errors->has('prenume'))
              <span class="error-message">{{ $errors->first('prenume') }}</span>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-4">
            {{ Form::input('date', 'data_nasterii', $profesor->{"data nasterii"}, array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data nasterii a profesorului")) }}
            @if ($errors->has('data_nasterii'))
              <span class="error-message">{{ $errors->first('data_nasterii') }}</span>
            @endif
          </div>
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::submit('Editeaza Profesor', array('class'=>'btn btn-primary')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
