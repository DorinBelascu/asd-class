<?php 
    $starea = [ '-' => '[Selectati starea]', 'publica' => 'publica', 'privata' => 'privata'];
    $semestrul = ['-' => '[Selectati semestrul]' , '1' => 'Semestrul 1', '2' => 'Semestrul 2'];
    $note = ['-' => '[Selectati valoarea notei]', '1' => '1' , '2' => '2' , '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9' , '10' => '10']

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
                            {{ Form::select('nota-edit', $note, Input::old('Valoarea Notei') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Valoarea Notei", ))}}
                            <span id="error-nota-edit" class="error-message"></span>
                        </div>
                        <div class="col-md-6">
                            {{ Form::input('date', 'data-edit', $nota->data, array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data notei")) }}
                            <span id="error-data-edit" class="error-message"></span>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::select('starea-edit', $starea, Input::old('Starea Notei') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Starea Notei", ))}}
                            <span id="error-starea-edit" class="error-message"></span>  
                        </div>
                        <div class="col-md-6">
                            {{ Form::select('semestru-edit', $semestrul, Input::old('Semestrul Notei') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Semestrul Notei", ))}}
                            <span id="error-semestru-edit" class="error-message"></span>  
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    {{ Form::submit('Editeaza', array('id' =>'btn-edit', 'class' => "btn btn-success")) }}       
                </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>


