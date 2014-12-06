@extends('layout')

@section('content')

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Absentele lui {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie}} </div>
  <div class="panel-body">
      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-hover table-condensed table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Data</th>
              <th>Stare</th>
              <th>Created at</th>
              <th>Updated at</th>
            </tr>
          </thead>
          <tbody>
            @foreach($absente as $i => $absenta)
              @if ($elev->nume == $absenta->nume_elev)
                <tr>
                  <td>{{ $i+1 }}.</td>
                  <td>{{ $absenta->data}}</td>
                    @if ($absenta->stare == 0)
                      <td> Nemotivata </td> 
                    @else
                      <td> Motivata </td>
                    @endif
                  </td>
                  <td>{{ $absenta->created_at}}</td>
                  <td>{{ $absenta->updated_at}}</td>
                </tr>
              @endif
            @endforeach   
            </tbody>
          </table>
        </div>
</div>


@stop
