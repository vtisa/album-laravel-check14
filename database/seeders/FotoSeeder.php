<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Foto;
use App\Models\Album;

class FotoSeeder extends Seeder
{
    public function run()
    {
        $albumes = Album::all();

        foreach ($albumes as $album) {
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
}