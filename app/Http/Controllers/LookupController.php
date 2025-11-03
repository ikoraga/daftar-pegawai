<?php

namespace App\Http\Controllers;

use App\Services\LookupService;

class LookupController extends Controller
{
    protected $svc;

    public function __construct(LookupService $svc)
    {
        $this->svc = $svc;
    }

    public function index()
    {
        $data = $this->svc->getAll();

        return response()->json([
            'message' => 'Success',
            'data' => $data
        ]);
    }
}
