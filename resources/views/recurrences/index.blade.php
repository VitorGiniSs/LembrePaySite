
@extends('layouts.app')

@section('title', 'Minhas recorrências')
@section('breadcrumb', 'Minhas contas / Recorrências')
@section('page-title', 'Minhas recorrências')

@section('content')

<a href="{{ route('bills.create') }}" class="back-menu-card">
    <span>←</span>
    Voltar para tipos de conta
</a>

<section class="bills-card">

    <div class="bills-card-header">
        <div>
            <h2>Contas recorrentes</h2>
            <p>Acompanhe suas despesas periódicas.</p>
        </div>

        <a href="{{ route('recurrences.create') }}" class="primary-button">
            + Nova recorrência
        </a>
    </div>

    @if($recurrences->isEmpty())

        <div class="empty-state">
            <h3>Nenhuma recorrência cadastrada</h3>
            <p>Adicione contas como água, luz, internet ou aluguel.</p>

            <a href="{{ route('recurrences.create') }}" class="primary-button">
                Cadastrar recorrência
            </a>
        </div>

    @else

        <div class="table-container">
            <table class="bills-table">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Frequência</th>
                        <th>Primeiro vencimento</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($recurrences as $recurrence)
                        <tr>
                            <td>
                                <strong>{{ $recurrence->title }}</strong>
                                <br>
                                <small>
                                    {{ $recurrence->amount_type === 'fixed' ? 'Valor fixo' : 'Valor variável' }}
                                </small>
                            </td>

                            <td>
                                R$ {{ number_format((float) $recurrence->amount, 2, ',', '.') }}
                            </td>

                            <td>
                                @switch($recurrence->frequency)
                                    @case('weekly')
                                        Semanal
                                        @break
                                    @case('monthly')
                                        Mensal
                                        @break
                                    @case('yearly')
                                        Anual
                                        @break
                                @endswitch
                            </td>

                            <td>
                                {{ $recurrence->start_date->format('d/m/Y') }}
                            </td>

                            <td>
                                <span class="status-badge {{ $recurrence->is_active ? 'status-paid' : 'status-overdue' }}">
                                    {{ $recurrence->is_active ? 'Ativa' : 'Inativa' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endif

</section>

@endsection
