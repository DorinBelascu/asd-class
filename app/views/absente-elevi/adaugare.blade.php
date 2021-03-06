<?php 
    $motivata_sau_nemotivata = [ '-' => '[Selectati daca motivata sau nemotivata]', 'motivata' => 'motivata', 'nemotivata' => 'nemotivata'];
    $publica_sau_nu = ['privata' => 'privata'];
    $semestrul = ['-' => '[Selectati semestrul]' , '1' => 'Semestrul 1', '2' => 'Semestrul 2'];
?>  
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myLargeModalLabel">Adauga absenta noua elevului {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie->denumirea}}</h4>
            </div>
            {{ Form::open(['url'=> URL::route('add-new-absenta', ['id_elev' => $elev->id, 'id_materie' => $materie->id]), 'class' => 'form']) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::input('date', 'data', Carbon\Carbon::now()->format('Y-m-d'), array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data notei")) }}
                        <span id="error-data" class="error-message"></span>
                    </div>
                    <div class="col-md-6">
                        {{ Form::select('motivata_sau_nemotivata', $motivata_sau_nemotivata, Input::old('Motivata sau nemotivata') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Motivata sau nemotivata", ))}}
                        <span id="error-motivata_sau_nemotivata" class="error-message"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::select('publica_sau_nu', $publica_sau_nu, Input::old('Publica sau nu') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Publica sau nu", ))}}
                        <span id="error-publica_sau_nu" class="error-message"></span>
                    </div>
                    <div class="col-md-6">
                        {{ Form::select('semestrul', $semestrul, Input::old('Semestrul Notei') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Semestrul Notei", ))}}
                        <span id="error-semestrul" class="error-message"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                {{ Form::submit('Adauga', array('class' => 'btn btn-success','id' =>'btn-add')) }}       
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>