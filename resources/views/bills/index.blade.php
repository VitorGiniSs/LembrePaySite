@extends('layouts.app')

@section('title', 'Minhas contas')
@section('breadcrumb', 'Minhas contas')
@section('page-title', 'Minhas contas')

@section('content')
<div class="bills-page">

    <header class="bills-header">
        <div>
            <h1>Minhas contas</h1>
            <p>Gerencie seus pagamentos e vencimentos.</p>
        </div>

        <a href="{{ route('bills.create') }}" class="primary-button">
            + Nova conta
        </a>
    </header>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error-message">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <section class="bills-card">

        <div class="bills-card-header">
            <h2>Todos os pagamentos</h2>
            <span>{{ $bills->count() }} contas cadastradas</span>
        </div>

        @if($bills->isEmpty())

            <div class="empty-state">
                <h3>Nenhuma conta cadastrada</h3>
                <p>Comece adicionando sua primeira conta financeira.</p>

                <a href="{{ route('bills.create') }}" class="primary-button">
                    Cadastrar primeira conta
                </a>
            </div>

        @else

            <div class="table-container">
                <table class="bills-table">
                    <thead>
                        <tr>
                            <th>Descrição</th>
                            <th>Valor</th>
                            <th>Vencimento</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($bills as $bill)
                            <tr>
                                <td>
                                    <strong>{{ $bill->title }}</strong>
                                </td>

                                <td>
                                    R$ {{ number_format((float) $bill->amount, 2, ',', '.') }}
                                </td>

                                <td>
                                    {{ $bill->due_date->format('d/m/Y') }}
                                </td>

                                <td>
                                    <span class="status-badge status-{{ $bill->status }}">
                                        @switch($bill->status)
                                            @case('pending')
                                                Pendente
                                                @break
                                            @case('paid')
                                                Paga
                                                @break
                                            @case('overdue')
                                                Atrasada
                                                @break
                                        @endswitch
                                    </span>
                                </td>

                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('bills.show', $bill->id) }}">
                                            Visualizar
                                        </a>

                                        <a href="{{ route('bills.edit', $bill->id) }}">
                                            Editar
                                        </a>

                                        <form action="{{ route('bills.destroy', $bill->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Deseja realmente excluir esta conta?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="delete-button">
                                                Excluir
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endif

    </section>
@endsection
