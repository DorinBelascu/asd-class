<div class="modal fade" id="Modal{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            {{ Form::open(['url'=> URL::route('edit-materie'), 'class' => 'form']) }}
            <div class="modal-body">
                {{ Form::text('edit-materie', $materie->denumirea, array('class'=>'form-control', 'placeholder' => "Introduceti noua denumire")) }}
                <span id="error-denumire-editare" class="error-message"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                {{ Form::submit('Schimba', array('id' => 'btn-edit', 'class' => 'btn btn-success')) }}    
                {{ Form::hidden('id', $materie->id)}}   
            </div>
            {{ Form::close() }}

        </div>
    </div>
</div>