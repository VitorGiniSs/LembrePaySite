
@extends('layouts.app')

@section('title', 'Configurar e-mail')
@section('breadcrumb', 'Notificações / Configurar e-mail')
@section('page-title', 'Configurar e-mail')

@section('content')

<section class="notification-intro">
    <h3>Onde deseja receber seus avisos?</h3>
    <p>Informe o endereço de e-mail que receberá os lembretes das suas contas.</p>
</section>

<div class="bills-card">
    <form action="{{ route('notifications.store') }}" method="POST" class="bill-form">
        @csrf

        <div class="form-group">
            <label for="destination">Endereço de e-mail</label>

            <input
                type="email"
                id="destination"
                name="destination"
                placeholder="exemplo@gmail.com"
                value="{{ old('destination') }}"
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
                Salvar e-mail
            </button>
        </div>
    </form>
</div>

@endsection