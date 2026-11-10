
@extends('layouts.app')

@section('title', 'Nova conta recorrente')
@section('breadcrumb', 'Minhas contas / Recorrências / Nova')
@section('page-title', 'Nova conta recorrente')

@section('content')

<a href="{{ route('bills.create') }}" class="back-menu-card">
    <span>←</span>
    Voltar para tipos de conta
</a>

<div class="type-selection-intro">
    <h2>Dados da recorrência</h2>
    <p>Cadastre uma despesa que se repete periodicamente.</p>
</div>

<section class="bills-card">

    <form action="{{ route('recurrences.store') }}" method="POST" class="bill-form">
        @csrf

        <div class="form-group">
            <label for="title">Nome da conta</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                placeholder="Ex: Conta de energia"
                required
            >
            @error('title')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="amount">Valor (R$)</label>
                <input
                    type="number"
                    id="amount"
                    name="amount"
                    value="{{ old('amount') }}"
                    step="0.01"
                    min="0.01"
                    placeholder="0,00"
                    required
                >
                @error('amount')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="amount_type">Tipo de valor</label>
                <select id="amount_type" name="amount_type" required>
                    <option value="fixed" {{ old('amount_type', 'fixed') == 'fixed' ? 'selected' : '' }}>
                        Valor fixo
                    </option>
                    <option value="variable" {{ old('amount_type') == 'variable' ? 'selected' : '' }}>
                        Valor variável
                    </option>
                </select>
                @error('amount_type')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="frequency">Frequência</label>
                <select id="frequency" name="frequency" required>
                    <option value="">Selecione</option>
                    <option value="weekly" {{ old('frequency') == 'weekly' ? 'selected' : '' }}>Semanal</option>
                    <option value="monthly" {{ old('frequency') == 'monthly' ? 'selected' : '' }}>Mensal</option>
                    <option value="yearly" {{ old('frequency') == 'yearly' ? 'selected' : '' }}>Anual</option>
                </select>
                @error('frequency')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="start_date">Primeiro vencimento</label>
                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value="{{ old('start_date') }}"
                    required
                >
                @error('start_date')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="end_date">Data final (opcional)</label>
            <input
                type="date"
                id="end_date"
                name="end_date"
                value="{{ old('end_date') }}"
            >
            <small>Deixe vazio se a cobrança não tiver previsão para terminar.</small>
            @error('end_date')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('bills.create') }}" class="cancel-button">
                Cancelar
            </a>

            <button type="submit" class="primary-button">
                Salvar recorrência
            </button>
        </div>

    </form>

</section>

@endsection
