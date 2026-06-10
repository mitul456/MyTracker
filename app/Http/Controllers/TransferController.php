<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Services\TransferService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransferController extends Controller
{
    protected $transferRepo;
    public function __construct(TransferService $transferRepo)
    {
        $this->transferRepo = $transferRepo;
    }
    public function index()
    {
        $transfers = $this->transferRepo->getAll();
        return Inertia::render('Transfers/Index', ['transfers' => $transfers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Transfers/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}
