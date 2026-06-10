<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferCreate;
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
        
        $accounts = $this->transferRepo->accounts();
        return Inertia::render('Transfers/Create', ['accounts' => $accounts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransferCreate $request)
    {
        $data = $request->validated();
        
        $this->transferRepo->create($data);
        return redirect()->route('transfers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transfer = $this->transferRepo->find($id);
        return Inertia::render('Transfers/Show', ['transfer' => $transfer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transfer = $this->transferRepo->find($id);
        // $accounts = $this->transferRepo->accounts();
        return Inertia::render('Transfers/Edit', ['transfer' => $transfer, 'accounts' => $this->transferRepo->accounts()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransferCreate $request, $id)
    {
        $data = $request->validated();
        $this->transferRepo->update($id, $data);
        return redirect()->route('transfers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->transferRepo->delete($id);
        return redirect()->route('transfers.index');
    }
}
