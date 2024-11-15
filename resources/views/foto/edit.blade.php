@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Foto') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    @endif

                    <form action="{{ route('foto.update', ['foto' => $foto->foto_id]) }}" method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT')                    
                    
                        <div class="form-group">
                            <label for="foto_nombre">Nombre de la Foto</label>
                            <input type="text" name="foto_nombre" id="foto_nombre" class="form-control" value="{{ $foto->foto_nombre }}" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="foto_descripcion">Descripción de la Foto</label>
                            <textarea name="foto_descripcion" id="foto_descripcion" class="form-control" required>{{ $foto->foto_descripcion }}</textarea>
                        </div>
                    
                        <div class="form-group">
                            <label for="foto_ruta">Imagen</label>
                            <input type="file" name="foto_ruta" id="foto_ruta" class="form-control">
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection