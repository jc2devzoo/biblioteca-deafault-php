<?php

namespace App\Http\Controllers;

use App\Models\loans;
use Illuminate\Http\Request;

class LoansControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('loans_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loans_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'id_user' => 'required|integer',
            'id_book' => 'required|integer',
            'data_emprestimo' => 'required|date',
            'data_devolucao' => 'nullable|date',
            'n_renovacoes' => 'nullable|integer',
        ]);

        // Create a new loan record in the database
        $loan = new loans();
        $loan->id_user = $validatedData['id_user'];
        $loan->id_book = $validatedData['id_book'];
        $loan->data_emprestimo = $validatedData['data_emprestimo'];
        $loan->data_devolucao = $validatedData['data_devolucao'] ?? null;
        $loan->n_renovacoes = $validatedData['n_renovacoes'] ?? 0;
        $loan->save();

        // Redirect or return a response
        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the loan by its ID
        $loan = loans::findOrFail($id);

        // Return a view with the loan details
        return view('loans_show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the loan by its ID
        $loan = loans::findOrFail($id);

        // Return a view with the loan details for editing
        return view('loans_edit', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'id_user' => 'required|integer',
            'id_book' => 'required|integer',
            'data_emprestimo' => 'required|date',
            'data_devolucao' => 'nullable|date',
            'n_renovacoes' => 'nullable|integer',
        ]);

        // Retrieve the loan by its ID
        $loan = loans::findOrFail($id);

        // Update the loan attributes
        $loan->id_user = $validatedData['id_user'];
        $loan->id_book = $validatedData['id_book'];
        $loan->data_emprestimo = $validatedData['data_emprestimo'];
        $loan->data_devolucao = $validatedData['data_devolucao'] ?? null;
        $loan->n_renovacoes = $validatedData['n_renovacoes'] ?? 0;
        $loan->save();

        // Redirect or return a response
        return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Retrieve the loan by its ID
        $loan = loans::findOrFail($id);

        // Delete the loan from the database
        $loan->delete();

        // Redirect or return a response
        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
    }
}
