<?php

namespace App\Http\Controllers;

use App\Http\Controllers\NotificationChannelController;
use Illuminate\Http\Request;

class NotificationChannelController extends Controller
{
    public function index()
    {
        $channels = auth()->user()
            ->notificationChannels()
            ->orderBy('created_at')
            ->get();

        return view('notifications.index', compact('channels'));
    }
    
public function store(Request $request)
{
    $validated = $request->validate([
        'destination' => ['required', 'email', 'max:255'],
    ]);

    $alreadyExists = auth()->user()
        ->notificationChannels()
        ->where('type', 'email')
        ->where('destination', $validated['destination'])
        ->exists();

    if ($alreadyExists) {
        return back()
            ->withErrors([
                'destination' => 'Este e-mail já está cadastrado.',
            ])
            ->withInput();
    }

    auth()->user()->notificationChannels()->create([
        'type' => 'email',
        'destination' => $validated['destination'],
        'is_active' => true,
    ]);

    return redirect()
        ->route('notifications.index')
        ->with('success', 'E-mail cadastrado com sucesso!');
}
public function edit(string $id)
{
    $channel = auth()->user()
        ->notificationChannels()
        ->findOrFail($id);

    return view('notifications.edit', compact('channel'));
}
public function update(Request $request, string $id)
{
    $channel = auth()->user()
        ->notificationChannels()
        ->findOrFail($id);

    $validated = $request->validate([
        'destination' => ['required', 'email', 'max:255'],
    ]);

    $channel->update([
        'destination' => $validated['destination'],
    ]);

    return redirect()
        ->route('notifications.index')
        ->with('success', 'E-mail atualizado com sucesso!');
}
public function toggle(string $id)
{
    $channel = auth()->user()
        ->notificationChannels()
        ->findOrFail($id);

    $channel->update([
        'is_active' => !$channel->is_active,
    ]);

    $message = $channel->is_active
        ? 'Notificações ativadas com sucesso!'
        : 'Notificações desativadas com sucesso!';

    $status = $channel->is_active ? 'success' : 'warning';

    return redirect()
        ->route('notifications.index')
        ->with('success', $message)
        ->with('alert_type', $status);
}
public function destroy(string $id)
{
    $channel = auth()->user()
        ->notificationChannels()
        ->findOrFail($id);

    $channel->delete();

    return redirect()
        ->route('notifications.index')
        ->with('success', 'Canal de notificação excluído com sucesso!');
}
}
