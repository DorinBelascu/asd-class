<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Subject To {{ $profesor->nume . ' ' . $profesor->prenume }}</h4>
      </div>

      <div class="modal-body">
        {{ Form::open(['url'=> URL::route('profesor_materii_add'), 'class' => 'form']) }}
        {{ Form::hidden('id', $profesor->id)}} 
        <div class="row">
          {{ Form::select('lista_materii', $lista, Input::old('Denumirea Materiei') , array('class'=>'form-control', 'data-toggle'=>'tooltip', 'title' => "Lista de Materii Disponibile", ))}}
            <span id="error-genul" class="error-message"></span>
        </div>
      </div>
      <div class="modal-footer">
        {{ Form::submit('Adauga Materie', array('class'=>'btn btn-success', 'id'=>'btn-add')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         {{ Form::close() }}
      </div>
      
    </div>
  </div>
</div>