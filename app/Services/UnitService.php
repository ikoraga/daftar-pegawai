<?php

namespace App\Services;

use App\Models\Units;
use Illuminate\Support\Str;

class UnitService
{
    public function getTree()
    {
        return Units::with('children.children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
    }

    public function show(Units $unit)
    {
        return $unit->load('parent', 'children.children');

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
        if ($unit->children()->exists()) {
            throw new \Exception('Unit ini masih memiliki sub-unit dan tidak dapat dihapus.');
        }

        $unit->delete();
    }
}
