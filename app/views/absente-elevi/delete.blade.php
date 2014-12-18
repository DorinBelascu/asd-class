<!-- Modal -->

<div class="modal fade" id="delete-{{ $absenta->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete absenta ( {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie->denumirea}} )</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(['url'=> URL::route('delete-absenta'), 'class' => 'form']) }}
        {{ Form::hidden('id', $absenta->id) }}
        {{ Form::hidden('id_elev', $elev->id) }}
        {{ Form::hidden('denumirea', $materie->denumirea) }}
        Esti sigur ca vrei sa stergi absenta lui "{{ $elev->nume . ' ' . $elev->prenume }}"?
      </div>
      <div class="modal-footer">
        {{ Form::submit('Sterge absenta', array('class'=>'btn btn-danger')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>  
        {{ Form::close() }}
    </div>
  </div>
</div>
