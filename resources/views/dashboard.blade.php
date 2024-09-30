@extends('layouts.appp')
@section('titulo', 'Home')
@section('contenido')
    <div class="row">
        <h1> Bienvenido {{ auth()->user()->name }} </h1>
    </div>
@endsection