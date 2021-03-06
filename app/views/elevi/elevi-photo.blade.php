@extends('layout')

@section('content')
<div class="row">
  @if ( Session::get('result-success'))
    <div class="alert alert-success" role="alert">{{Session::get('result-success')}}</div>
  @elseif ($errors->all()) 
    <div class="col-md-12 alert alert-danger">{{$errors->all()[0] }}</span>
    </div>
  @endif
</div>

<div class="panel panel-primary">
  <div class="panel-heading">Adauga sau schimba poza elevului</div>
  <div class="panel-body">

      <div class="row">
        <div class="col-md-6">
          <table class="table table-hover">
            <tr><th>Nume</th><td>{{$elev->nume}}</td></tr>
            <tr><th>Prenume</th><td>{{$elev->prenume}}</td></tr>
            <tr><th>Genul</th><td>{{HTML::image('images/' . $elev->genul . '.png', $elev->genul, ['width' => '32px', 'title' => $elev->genul])}} </td></tr>
            <tr><th>Data nasterii</th><td>{{$elev->{'data nasterii'} }}</td></tr>
          </table>
        </div>

        <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div style="width: 240px; text-align:center; margin:0px auto">
                  {{ HTML::image('images/photos/elevi/' . str_replace('(-)', 'medium', $elev->photo), $elev->photo,['class' => 'img-responsive', 'style' => 'width:100%']) }} 
                </div>
              </div>
            </div>

          @if(User::canChange() || $user_este_elev)
            <div class="row">
              <div class="col-md-12">
                
                <div style="width: 240px; text-align:center; margin:0px auto;">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 240px; height: 240px;">
                      </div>

                      {{ Form::open(['method'=>'post', 'files'=>true, 'url'=>URL::route('save-elev-photo-upload', ['id'=>$elev->id])])}}
                      <div>
                        <span class="btn btn-default btn-file">
                          <span class="fileinput-new">Selecteaza imaginea</span>
                          <span class="fileinput-exists">Schimba</span>
                          <input type="file" name="photo-elev" />
                          
                        </span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Sterge</a>
                        <button class="btn btn-default fileinput-exists"> Incarca </button>
                      </div>
                      {{ Form::close() }}
                  </div>
                </div>
               </div>
            </div>
          @endif
        </div>
      </div>
  </div>
</div>
@stop