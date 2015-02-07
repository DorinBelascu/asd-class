<?php 
    $starea = [ '-' => '[Selectati starea]', 'publica' => 'publica', 'privata' => 'privata'];
    $semestrul = ['-' => '[Selectati semestrul]' , '1' => 'Semestrul 1', '2' => 'Semestrul 2'];
    $notele = ['-' => '[Selectati valoarea tezei]', '1' => '1' , '2' => '2' , '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9' , '10' => '10'];

?>  
<!-- Modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myLargeModalLabel">Adauga teza elevului {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie->denumirea}}</h4>
                </div>
                {{ Form::open(['url'=> URL::route('add-new-teza', ['id_elev' => $elev->id, 'id_materia' => $materie->id]), 'class' => 'form']) }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::select('nota-teza', $notele, Input::old('Notele') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Introduceti o nota de la 1 la 10", ))}}
                            <span id="error-nota-teza-adaugare" class="error-message"></span>
                        </div>
                        <div class="col-md-6">
                            {{ Form::input('date', 'data-teza', Carbon\Carbon::now()->format('Y-m-d'), array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Data notei")) }}
                            <span id="error-data-teza-adaugare" class="error-message"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::select('starea-teza', $starea, Input::old('Starea Notei') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Starea Notei", ))}}
                            <span id="error-starea-teza-adaugare" class="error-message"></span>
                        </div>
                    <?php
                        if ($exista_teza1 == 1) {
                            unset($semestrul['1']);
                        } 
                        elseif ($exista_teza2 == 1) 
                        {
                            unset($semestrul['2']);
                        }
                        
                    ?>
                        <div class="col-md-6">
                            {{ Form::select('semestrul-teza', $semestrul, Input::old('Semestrul Notei') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Semestrul Notei", ))}}
                            <span id="error-semestrul-teza-adaugare" class="error-message"></span>
                        </div>
                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    {{ Form::submit('Adauga', array('id' =>'btn-add-teza', 'class' => "btn btn-warning")) }}       
                </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>

