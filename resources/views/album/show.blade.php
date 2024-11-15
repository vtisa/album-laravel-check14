@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Detalle del Álbum') }}</div>

                <div class="card-body">
                    <h5>Nombre del Álbum:</h5>
                    <p>{{ $album->album_nombre }}</p>

                    <h5>Descripción del Álbum:</h5>
                    <p>{{ $album->album_descripcion }}</p>

                    <h5>Usuario:</h5>
                    <p>{{ $album->usuario->nombre }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection