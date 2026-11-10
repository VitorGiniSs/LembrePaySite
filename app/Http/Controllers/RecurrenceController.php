<?php

namespace App\Http\Controllers;

use App\Models\Recurrence;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class RecurrenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $recurrences = auth()->user()
        ->recurrences()
        ->orderBy('start_date')
        ->get();

    return view('recurrences.index', compact('recurrences'));
}

    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    return view('recurrences.create');
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'amount' => ['required', 'numeric', 'min:0.01'],
        'amount_type' => ['required', Rule::in(['fixed', 'variable'])],
        'frequency' => ['required', Rule::in(['weekly', 'monthly', 'yearly'])],
        'start_date' => ['required', 'date'],
        'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
    ]);

    auth()->user()->recurrences()->create($validated);

    return redirect()
        ->route('recurrences.index')
        ->with('success', 'Conta recorrente cadastrada com sucesso!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
