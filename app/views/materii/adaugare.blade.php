    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myLargeModalLabel">Adauga materie 9</h4>
                </div>
                {{ Form::open(['url'=> URL::route('add-new-materie'), 'class' => 'form']) }}
                <div class="modal-body">
                   {{ Form::text('add_materie', null, array('class'=>'form-control', 'placeholder' => "Denumirea")) }}
                    <span id="error-denumire" class="error-message"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    {{ Form::submit('Adauga', array('id' =>'btn-add', 'class' => "btn btn-success")) }}       
                </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>