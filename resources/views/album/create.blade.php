@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crear Álbum') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('album.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="album_nombre">Nombre del Álbum</label>
                            <input type="text" name="album_nombre" id="album_nombre" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="album_descripcion">Descripción del Álbum</label>
                            <textarea name="album_descripcion" id="album_descripcion" class="form-control" required></textarea>
                        </div>

                        <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">

                        <button type="submit" class="btn btn-primary">Crear Álbum</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection