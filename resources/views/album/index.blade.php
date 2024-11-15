@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('correcto'))
        <div class="alert alert-success">
            <strong>Realizado</strong> Proceso Correcto. <br><br>
            {{ Session::get('correcto') }}
        </div>
    @endif

    <div class="row">
        @foreach($albumes as $album)
            <div class="col-sm-6 col-md-4 col-12 pt-1 album-container" data-album="{{ $album->album_nombre }}">
                <div class="card">
                    <h5 class="card-header">
                        {{ $album->album_nombre }}
                        @if (session('album_actualizado') == $album->album_nombre)
                            <span class="badge badge-success ml-2 text-dark updated-badge" style="font-size: 1.125rem; font-weight: normal;">Actualizado</span>
                            <script>
                                // Añadir temporizador para eliminar el mensaje después de 3 segundos
                                setTimeout(function() {
                                    let updatedBadge = document.querySelector('.updated-badge');
                                    if (updatedBadge) {
                                        updatedBadge.remove();
                                    }
                                }, 3000);
                            </script>
                        @endif
                    </h5>
                    <div class="card-body">
                        <p class="card-text">{{ $album->album_descripcion }}</p>
                        <a href="{{ route('foto.index', ['album' => $album->album_id]) }}" class="btn btn-secondary">Ver Fotos</a>
                        <a href="{{ route('album.edit', ['album' => $album->album_id]) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('album.destroy', ['album' => $album->album_id]) }}" method="POST" onsubmit="return confirm('Está seguro que desea eliminar? Recuerde que se eliminarán todas las fotos de este álbum')">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="album_id" value="{{ $album->album_id }}">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <a href="{{ route('album.create') }}" class="btn btn-primary">Crear Álbum</a>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Verifica si hay un mensaje de álbum actualizado y muestra la etiqueta span
        let albumActualizado = "{{ session('album_actualizado') }}";

        if (albumActualizado) {
            let albumElement = document.querySelector(`[data-album="${albumActualizado}"]`);

            if (albumElement && !albumElement.querySelector('.updated-badge')) {
                let updatedBadge = document.createElement('span');
                updatedBadge.classList.add('badge', 'badge-success', 'ml-2', 'text-dark', 'updated-badge'); // Agrega la clase text-dark para el color negro
                updatedBadge.style.fontSize = '1.125rem'; // Agrega el estilo de tamaño de fuente
                updatedBadge.style.fontWeight = 'normal'; // Establece la fuente a normal, sin negrita
                updatedBadge.innerText = 'Actualizado';

                albumElement.querySelector('.card-header').appendChild(updatedBadge);

                // Añadir temporizador para eliminar el mensaje después de 3 segundos
                setTimeout(function() {
                    updatedBadge.remove();
                }, 3000);
            }
        }

        // Verifica si hay un mensaje de álbum creado y muestra la alerta
        let albumCreado = "{{ session('correcto_crear_album') }}";

        if (albumCreado) {
            let alert = document.createElement('div');
            alert.classList.add('alert', 'alert-success', 'mt-3');
            alert.innerText = albumCreado;

            document.querySelector('.container').appendChild(alert);
        }
    });
</script>
@endsection
