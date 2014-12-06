@extends('layout')

@section('content')

<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Notele lui {{ $elev->prenume . ' ' . $elev->nume }} la {{$materie}} </div>
  <div class="panel-body">
      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-hover table-condensed table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Valoare</th>
              <th>Data</th>
              <th>Created at</th>
              <th>Updated at</th>
            </tr>
          </thead>
          <tbody>
            @foreach($note as $i => $nota)
              @if ($elev->id == $nota->elev_id)
                <tr>
                  <td>{{ $i+1 }}.</td>
                  <td>{{ $nota->valoare }}</td>
                  <td>{{ $nota->data}}</td>
                  <td>{{ $nota->created_at}}</td>
                  <td>{{ $nota->updated_at}}</td>
                </tr>
              @endif
            @endforeach   
            </tbody>
          </table>
        </div>
</div>


@stop
