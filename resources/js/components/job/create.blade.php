@extends('layouts.app')
@section('content')
  <div class="d-flex justify-content-between">
    <div class="">
      <span class="h1">Nuevo Cargo/Puesto</span>
    </div>
    <div class="my-auto">
      {{-- <a class="btn btn-info" href="{{route('customerBusinesses.create')}}" name="button">Nuevo <i data-feather='plus'></i></a> --}}
    </div>
  </div>
  <hr>
  <form action="{{ route('jobs.store') }}" method="post">
    @csrf
    <input class="form-control form-group" type="text" name="name" placeholder="Nombre del cargo/puesto" required>
    <button class="btn btn-info float-right" type="submit" name="button">Guardar <i data-feather='save'></i></button>
  </form>
@endsection
