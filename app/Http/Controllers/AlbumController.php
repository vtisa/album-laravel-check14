<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $albumes = Album::where('usuario_id', Auth::user()->id)->get();
        return view('album.index', compact('albumes'));
    }

    public function create()
    {
        return view('album.create');
    }

    public function store(Request $request)
    {
        $album = new Album;
        $album->album_nombre = $request->input('album_nombre');
        $album->album_descripcion = $request->input('album_descripcion');
        $album->usuario_id = $request->input('usuario_id');
        $album->save();

        return redirect('/album')->with('correcto', 'Álbum almacenado en la base de datos');
    }

    public function edit($album)
    {
        $album = Album::find($album);
        return view('album.edit', compact('album'));
    }

    public function update(Request $request, $album)
    {
        $request->validate([
            'album_nombre' => 'required',
            'album_descripcion' => 'required',
        ]);

        $album = Album::find($album);

        if (!$album) {
            abort(404);
        }

        $album->update([
            'album_nombre' => $request->input('album_nombre'),
            'album_descripcion' => $request->input('album_descripcion'),
        ]);

                // Agregar mensaje de sesión
    session()->flash('album_actualizado', $request->input('album_nombre'));

        return redirect('/album')->with('actualizado', 'Álbum actualizado exitosamente');
    }


    public function destroy(Request $request)
    {
        $album_id = $request->get('album_id');
        $album = Album::find($album_id);
        $album->fotos()->delete();
        $album->delete();

        return redirect('/album')->with('correcto', 'El álbum ha sido eliminado');
    }
    
    public function missingMethod($parameters = array())
    {
        abort(404);
    }
}