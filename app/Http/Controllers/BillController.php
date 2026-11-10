<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{

    public function index()
    {
        $bills = auth()->user()
            ->bills()
            ->orderBy('due_date')
            ->get();

        return view('bills.index', compact('bills'));
    }
public function create()
{
    return view('bills.choose-type');
}

public function createAvulsa()
{
    return view('bills.create');
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'due_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
        ]);

        auth()->user()->bills()->create($validated);

        return redirect()
            ->route('bills.index')
            ->with('success', 'Conta cadastrada com sucesso!');
    }
    public function show(string $id)
    {
        $bill = auth()->user()->bills()->findOrFail($id);

        return view('bills.show', compact('bill'));
    }

    public function edit(string $id)
    {
        $bill = auth()->user()->bills()->findOrFail($id);

        return view('bills.edit', compact('bill'));
    }

    public function update(Request $request, string $id)
    {
        $bill = auth()->user()->bills()->findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'due_date' => ['required', 'date'],
            'status' => ['required', 'in:pending,paid,overdue'],
            'description' => ['nullable', 'string'],
        ]);

    $validated['paid_at'] = $validated['status'] === 'paid'
    ? ($bill->paid_at ?? now())
    : null;

    $bill->update($validated);

        return redirect()
            ->route('bills.index')
            ->with('success', 'Conta atualizada com sucesso!');
    }

    public function destroy(string $id)
    {
        $bill = auth()->user()->bills()->findOrFail($id);

        $bill->delete();

        return redirect()
            ->route('bills.index')
            ->with('success', 'Conta excluída com sucesso!');
    }
}
