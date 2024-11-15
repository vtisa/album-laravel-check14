<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;

class FotoController extends Controller
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
        $fotos = Foto::all();
        return view('foto.index', compact('fotos'));
    }

    public function create()
    {
        return view('foto.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto_nombre' => 'required',
            'foto_descripcion' => 'required',
            'foto_ruta' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $foto = new Foto;
        $foto->foto_nombre = $request->input('foto_nombre');
        $foto->foto_descripcion = $request->input('foto_descripcion');

        if ($request->hasFile('foto_ruta')) {
            $foto_ruta = $request->file('foto_ruta');
            $foto_ruta_nombre = time() . '_' . $foto_ruta->getClientOriginalName();
            $foto_ruta->storeAs('public/fotos', $foto_ruta_nombre);
            $foto->foto_ruta = 'fotos/' . $foto_ruta_nombre;
        }

        $foto->save();

        return redirect('/foto')->with('correcto', 'Foto almacenada en la base de datos');
    }

    public function edit($id)
    {
        $foto = Foto::find($id);
        return view('foto.edit', compact('foto'));
    }

    public function update(Request $request, $foto)
    {
        $request->validate([
            'foto_nombre' => 'required',
            'foto_descripcion' => 'required',
            'foto_ruta' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $foto = Foto::find($foto);

        if (!$foto) {
            abort(404);
        }

        $foto->update([
            'foto_nombre' => $request->input('foto_nombre'),
            'foto_descripcion' => $request->input('foto_descripcion'),
        ]);

        if ($request->hasFile('foto_ruta')) {
            $foto_ruta = $request->file('foto_ruta');
            $foto_ruta_nombre = time() . '_' . $foto_ruta->getClientOriginalName();
            $foto_ruta->storeAs('public/fotos', $foto_ruta_nombre);
            $foto->update(['foto_ruta' => 'fotos/' . $foto_ruta_nombre]);
        }
        

        return redirect('/foto')->with('correcto', 'Foto actualizada exitosamente');
    }

    public function destroy($id)
    {
        $foto = Foto::find($id);

        if (!$foto) {
            abort(404);
        }

        $foto->delete();

        return redirect('/foto')->with('correcto', 'La foto ha sido eliminada');
    }
}
