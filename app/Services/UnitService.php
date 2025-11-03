<?php

namespace App\Services;

use App\Models\Units;
use Illuminate\Support\Str;

class UnitService
{
    public function getTree()
    {
        return Units::with('children')->whereNull('parent_id')->get();
    }

    public function create(array $data)
    {
        $data['id'] = (string) Str::ulid();
        return Units::create($data);
    }

    public function update(Units $unit, array $data)
    {
        $unit->update($data);
        return $unit;
    }

    public function delete(Units $unit)
    {
        $unit->delete();
    }
}
