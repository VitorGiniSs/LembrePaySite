
@extends('layouts.app')

@section('title', 'Editar e-mail')
@section('breadcrumb', 'Notificações / Editar e-mail')
@section('page-title', 'Editar e-mail')

@section('content')

<section class="notification-intro">
    <h3>Atualizar endereço de e-mail</h3>
    <p>Informe o novo endereço que receberá seus lembretes.</p>
</section>

<div class="bills-card">
    <form action="{{ route('notifications.update', $channel->id) }}" method="POST" class="bill-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="destination">Endereço de e-mail</label>

            <input
                type="email"
                id="destination"
                name="destination"
                value="{{ old('destination', $channel->destination) }}"
                required
            >

            @error('destination')
                <span class="field-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('notifications.index') }}" class="cancel-button">
                Cancelar
            </a>

            <button type="submit" class="primary-button">
                Salvar alterações
            </button>
        </div>
    </form>
</div>

@endsection
