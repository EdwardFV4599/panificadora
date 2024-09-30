@extends('layouts.appp')

@section('contenido')
<div class="container">
    <h1>Crear Materia Prima</h1>
    <form action="{{ route('materia_primas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="nombre" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" name="cantidad" id="cantidad" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="unidad">Unidad</label>
            <input type="text" class="form-control" name="unidad" id="unidad" required>
        </div>
        <div class="form-group">
            <label for
