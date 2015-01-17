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
                            {{ Form::text('nota', $nota->valoare , array('class'=>'form-control', 'placeholder' => "Adauga o nota intre 1 si 10")) }}
                        </div>
                        <div class="col-md-6">
                            {{ Form::input('date', 'data', $nota->data, array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data notei")) }}
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