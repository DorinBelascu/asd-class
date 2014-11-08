<div class="modal fade" id="delete-{{ $materie->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete materie ( {{ $materie->id }} )</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['url'=> URL::route('delete-materie'), 'class' => 'form']) }}
                {{ Form::hidden('id', $materie->id)}}
                Esti sigur ca vrei sa stergi materia {{ $materie->denumirea }}?
            </div>
            <div class="modal-footer">
                {{ Form::submit('Sterge Materia', array('class'=>'btn btn-danger')) }}
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>