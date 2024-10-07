@extends('layouts.appp')
@section('titulo', 'Home')
@section('contenido')
    <div class="mb-4">
        <h1> Bienvenido {{ auth()->user()->name }} </h1>
    </div>
@endsection