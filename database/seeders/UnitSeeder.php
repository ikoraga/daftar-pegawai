<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Units;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $su = Units::updateOrCreate([
            'name' => 'Sekretariat Utama',
            'kode' => 'SU',
            'isActive' => true,
            'parent_id' => null,
        ]);

        $bp = Units::updateOrCreate([
            'name' => 'Biro Perencanaan',
            'kode' => 'BP',
            'isActive' => true,
            'parent_id' => null,
        ]);

        Units::updateOrCreate([
            'name' => 'Subbagian Anggaran',
            'kode' => 'SA',
            'isActive' => true,
            'parent_id' => $bp->id,
        ]);
    }
}
