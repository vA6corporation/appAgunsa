@extends('layouts.app')
@section('content')
  <div class="d-flex justify-content-between">
    <div class="">
      <span class="h1">Cargos/Puestos de los trabajadores</span>
    </div>
    <div class="my-auto">
      <a class="btn btn-info" href="{{ route('jobs.create') }}" name="button">Nuevo <i data-feather='plus'></i></a>
    </div>
  </div>
  <hr>
  {{-- <pre>{{ json_encode($jobs, JSON_PRETTY_PRINT) }}</pre> --}}
  <ul class="list-group">
    <li class="list-group-item list-group-item-info lead">Lista de cargos definidos</li>
    @foreach ($jobs as $key => $item)
      <li class="list-group-item">{{ $item->name }}</li>
    @endforeach
  </ul>
@endsection
