@extends('layouts.app')
@section('content')
  <form action="{{ route('sales.store') }}" method="post" autocomplete="off">
    <div class="row">
      @csrf
      <div class="col-12">
        <orders-list class="" placeholder='Nombre del Cliente' :items='{{ json_encode($customers) }}'></orders-list>
      </div>
    </div>
  </form>
@endsection
