<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Adauga profesor nou de {{ $materie->denumirea }}</h4>
      </div>

      <div class="modal-body">
        {{ Form::open(['url'=> URL::route('materie_profesori_add'), 'class' => 'form']) }}
        {{ Form::hidden('id', $materie->id)}} 
        <div class="row">
          {{ Form::select('lista_profesori', $lista, Input::old('Nume Profesor') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Lista de Profesori Disponibili", ))}}
            <span id="error-genul" class="error-message"></span>
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::submit('Adauga Profesor', array('class'=>'btn btn-success', 'id'=>'btn-add')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         {{ Form::close() }}
      </div>
      
    </div>
  </div>
</div>