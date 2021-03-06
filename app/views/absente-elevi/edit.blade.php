<?php 
    $motivata_sau_nemotivata = [1 => 'motivata', 0 => 'nemotivata'];
    $publica_sau_nu = [1 => 'publica', 0 => 'privata'];
    $semestrul = [1 => 'Semestrul 1', 2 => 'Semestrul 2'];
?>  
<!-- Modal -->
<div class="modal fade" id="edit-{{ $absenta->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myLargeModalLabel">Editeasa absenta elevului {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie->denumirea}}</h4>
            </div>
            {{ Form::open(['url'=> URL::route('edit-absenta',['id' => $absenta->id]), 'class' => 'form']) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::input('date', 'data-edit', $absenta->data, array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data notei")) }}
                        <span id="error-data-edit" class="error-message"></span>
                    </div>
                    <div class="col-md-6">
                        {{ Form::select('motivata_sau_nemotivata', $motivata_sau_nemotivata, $absenta->stare , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Motivata sau nemotivata" ))}}
                        <span id="error-nota" class="error-message"></span>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-md-6">
                        {{ Form::select('publica_sau_nu', $publica_sau_nu, $absenta->publica_sau_nu , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Publica sau nu" ))}}
                        <span id="error-starea" class="error-message"></span>
                    </div>
                    <div class="col-md-6">
                            {{ Form::select('semestrul', $semestrul, $absenta->semestru , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Semestrul Notei" ))}}
                            <span id="error-starea-edit" class="error-message"></span>  
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