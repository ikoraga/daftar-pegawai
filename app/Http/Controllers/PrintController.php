<?php

namespace App\Http\Controllers;

use App\Services\PrintService;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    protected $svc;

    public function __construct(PrintService $svc)
    {
        $this->svc = $svc;
    }

    public function employees(Request $req)
    {
        return $this->svc->daftarPegawai($req->unit_id);
    }
}
