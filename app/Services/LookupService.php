<?php

namespace App\Services;

use App\Models\{Religions, Ranks, Echelons, Positions};

class LookupService
{
    public function getAll()
    {
        return [
            'religions' => Religions::all(['id', 'name']),
            'ranks' => Ranks::all(['id', 'code', 'name']),
            'echelons' => Echelons::all(['id', 'code', 'name']),
            'positions' => Positions::all(['id', 'name']),
        ];
    }
}
