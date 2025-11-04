<?php

namespace App\Http\Controllers;

use App\Models\Units;
use App\Services\UnitService;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    protected $svc;

    public function __construct(UnitService $svc)
    {
        $this->svc = $svc;
    }

    public function index()
    {
        return response()->json($this->svc->getTree());
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:120',
            'kode' => 'nullable|string|max:10|unique:units,kode',
            'parent_id' => 'nullable|string|size:26|exists:units,id',
        ]);
        return response()->json($this->svc->create($req->all()), 201);
    }

    public function update(Request $req, Units $unit)
    {
        $req->validate([
            'name' => 'required|string|max:120',
            'kode' => 'nullable|string|max:10|unique:units,kode,' . $unit->id,
            'parent_id' => 'nullable|string|size:26|exists:units,id',
        ]);
        return response()->json($this->svc->update($unit, $req->all()));
    }

    public function destroy(Units $unit)
    {
        $this->svc->delete($unit);
        return response()->json(['message' => 'Unit berhasil dihapus']);
    }
}
