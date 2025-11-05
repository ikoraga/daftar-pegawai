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
        return successResponse($this->svc->getTree());
    }
    public function show(Units $unit)
    {
        return successResponse($this->svc->show($unit));
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:120',
            'kode' => 'nullable|string|max:10|unique:units,kode',
            'parent_id' => 'nullable|string|size:26|exists:units,id',
        ]);
        return successResponse($this->svc->create($req->all()));
    }

    public function update(Request $req, Units $unit)
    {
        $req->validate([
            'name' => 'required|string|max:120',
            'kode' => 'nullable|string|max:10|unique:units,kode,' . $unit->id,
            'parent_id' => 'nullable|string|size:26|exists:units,id',
        ]);
        return successResponse($this->svc->update($unit, $req->all()));
    }

    public function destroy(Units $unit)
    {
        $this->svc->delete($unit);

        return successResponse(null, 'Unit berhasil dihapus');
    }
}
