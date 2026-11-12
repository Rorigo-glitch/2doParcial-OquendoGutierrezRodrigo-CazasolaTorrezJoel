@extends('layouts.app')
@section('contenido')
<h1>Nuevo producto</h1>
<form method="POST" action="{{ route('productos.store') }}">
  @csrf
  @include('productos._form')
</form>
@endsection
