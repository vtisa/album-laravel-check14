<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Album;
use App\Models\Foto;
use App\Models\User;

class AlbumSeeder extends Seeder
{
    public function run()
    {
        $usuarios = User::all();

        foreach ($usuarios as $usuario) {
            $cantidad = mt_rand(0, 15);
            for ($i = 0; $i < $cantidad; $i++) {
                $album = $usuario->albumes()->create([
                    'album_nombre' => "Nombre Album",
                    'album_descripcion' => "Descripción álbum",
                ]);

                $this->crearFotosParaAlbum($album);
            }
        }
    }

    private function crearFotosParaAlbum(Album $album)
    {
        $cantidad = mt_rand(0, 5);
        for ($i = 0; $i < $cantidad; $i++) {
            $foto = new Foto([
                'foto_nombre' => "Nombre Foto",
                'foto_descripcion' => "Descripción foto",
                'foto_ruta' => "/img/text.png",
            ]);

            $album->fotos()->save($foto);
        }
    }
}