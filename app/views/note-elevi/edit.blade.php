<?php 
    $note_edit = ['1' => '1' , '2' => '2' , '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9' , '10' => '10'];

    $starea_edit = array();
    if ($nota->publica_sau_nu == 1 )
    {
        $starea_edit['publica'] = 'publica';
        $starea_edit['privata'] = 'privata';
    }
    else
    {
        $starea_edit['privata'] = 'privata';
        $starea_edit['publica'] = 'publica';
    }

    $semestru_edit = array();
    if ( $nota->semestru == 1 )
    {
        $semestru_edit['1'] = 'Semestrul 1';
        $semestru_edit['2'] = 'Semestrul 2';
    }
    else
    {
        $semestru_edit['2'] = 'Semestrul 2';
        $semestru_edit['1'] = 'Semestrul 1';
    }
    $aux = $note_edit[$nota->valoare];
    unset($note_edit[$nota->valoare]);
    array_unshift($note_edit,$aux);
    $note_edit = array_combine($note_edit, $note_edit);
?>  
<!-- Modal -->
    <div class="modal fade" id="edit-{{ $nota->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myLargeModalLabel">Editeaza nota {{ $nota->valoare }} elevului {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie->denumirea}}</h4>
                </div>
                {{ Form::open(['url'=> URL::route('edit-nota', ['id' => $nota->id]), 'class' => 'form']) }}
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::select('nota-edit', $note_edit, Input::old('Valoarea Notei') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Valoarea Notei", ))}}
                            <span id="error-nota-edit" class="error-message"></span>
                        </div>
                        <div class="col-md-6">
                            {{ Form::input('date', 'data-edit', $nota->data, array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data notei")) }}
                            <span id="error-data-edit" class="error-message"></span>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::select('starea-edit',  $starea_edit, Input::old('Starea Notei') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Starea Notei", ))}}
                            <span id="error-starea-edit" class="error-message"></span>  
                        </div>
                        <div class="col-md-6">
                            {{ Form::select('semestru-edit', $semestru_edit, Input::old('Semestrul Notei') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Semestrul Notei", ))}}
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