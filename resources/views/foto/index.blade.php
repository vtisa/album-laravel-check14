@extends('layouts.app')

@section('content')
@if (Session::has('correcto'))
    <div class="alert alert-success">
        <strong>Realizado</strong> Proceso Correcto. <br><br>
        {{ Session::get('correcto') }}
    </div>  
@endif
<div class="container">
    
    @if (isset($fotos) && count($fotos) > 0)
    <div class="row">
        @foreach ($fotos as $foto)
        <div class="col-sm-6 col-md-4 col-12 pt-1">
            <div class="card">
                <img src="{{ asset($foto->foto_ruta) }}" class="img-fluid" alt="Foto">
                <div class="card-body">
                    <h5 class="card-title">{{ $foto->foto_nombre }}</h5>
                    <p class="card-text">{{ $foto->foto_descripcion }}</p>
                    <a href="{{ route('foto.edit', ['foto' => $foto->foto_id]) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('foto.destroy', ['id' => $foto->foto_id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta foto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
        <div class="alert alert-danger">
            <p>No tienes fotos. ¡Agrega una!</p>
        </div>
    @endif
</div>
@endsection
