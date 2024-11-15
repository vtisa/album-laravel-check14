@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $foto->foto_nombre }}</div>

                <div class="card-body">
                    <p>{{ $foto->foto_descripcion }}</p>
                    <img src="{{ $foto->foto_ruta }}" alt="{{ $foto->foto_nombre }}" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection