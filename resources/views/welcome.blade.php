
@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="dashboard-welcome">
    <div>
        <h2>Olá, {{ auth()->user()->name }} 👋</h2>
        <p>Aqui está o resumo da sua vida financeira.</p>
    </div>

    <a href="{{ route('bills.create') }}" class="primary-button">
        + Nova conta
    </a>
</div>

<div class="dashboard-stats-grid">

    <div class="dashboard-stat-card stat-total">
        <span class="dashboard-stat-label">Total de contas</span>
        <strong>{{ $totalBills }}</strong>
        <small>Contas cadastradas</small>
    </div>

    <div class="dashboard-stat-card stat-paid">
        <span class="dashboard-stat-label">Contas pagas</span>
        <strong>{{ $paidCount }}</strong>
        <small>Pagamentos concluídos</small>
    </div>

    <div class="dashboard-stat-card stat-pending">
        <span class="dashboard-stat-label">Pendentes</span>
        <strong>{{ $pendingCount }}</strong>
        <small>Aguardando pagamento</small>
    </div>

    <div class="dashboard-stat-card stat-overdue">
        <span class="dashboard-stat-label">Atrasadas</span>
        <strong>{{ $overdueCount }}</strong>
        <small>Com vencimento ultrapassado</small>
    </div>

</div>

<div class="dashboard-main-grid">

    <section class="bills-card dashboard-balance-card">
        <div class="dashboard-balance-header">
            <span class="dashboard-stat-label">Total a pagar</span>
            <span class="dashboard-balance-icon">R$</span>
        </div>

        <h2>
            R$ {{ number_format((float) $pendingAmount, 2, ',', '.') }}
        </h2>

        <p>Valor acumulado das suas contas pendentes.</p>

        <a href="{{ route('bills.index') }}" class="dashboard-text-link">
            Consultar minhas contas →
        </a>
    </section>

    <section class="bills-card dashboard-recurrence-card">
        <div class="bills-card-header">
            <div>
                <h2>Recorrências</h2>
                <p>Suas despesas periódicas</p>
            </div>
        </div>

        <strong class="dashboard-recurrence-number">
            {{ $activeRecurrences }}
        </strong>

        <p>Recorrências ativas</p>

        <a href="{{ route('recurrences.index') }}" class="dashboard-text-link">
            Ver recorrências →
        </a>
    </section>

</div>

<section class="bills-card dashboard-upcoming">

    <div class="bills-card-header">
        <div>
            <h2>Próximos vencimentos</h2>
            <p>Suas próximas contas a pagar.</p>
        </div>

        <a href="{{ route('bills.index') }}" class="dashboard-text-link">
            Ver todas →
        </a>
    </div>

    @forelse($upcomingBills as $bill)

        <div class="dashboard-upcoming-item">
            <div>
                <strong>{{ $bill->title }}</strong>

                @php
                    $daysUntilDue = (int) today()->diffInDays($bill->due_date, false);
                @endphp

                <small>
                    @if($daysUntilDue < 0)
                        <span class="dashboard-due-badge is-overdue">
                            Atrasada há {{ abs($daysUntilDue) }} dia(s)
                        </span>
                    @elseif($daysUntilDue === 0)
                        <span class="dashboard-due-badge is-today">
                            Vence hoje
                        </span>
                    @else
                        <span class="dashboard-due-badge is-upcoming">
                            @if($daysUntilDue === 1)
                                Vence amanhã
                            @else
                                Vence em {{ $daysUntilDue }} dias
                            @endif
                        </span>
                    @endif

                    · {{ $bill->due_date->format('d/m/Y') }}
                </small>
            </div>

            <strong>
                R$ {{ number_format((float) $bill->amount, 2, ',', '.') }}
            </strong>
        </div>

    @empty

        <div class="empty-state">
            <h3>Nenhum vencimento próximo</h3>
            <p>Quando você cadastrar contas, elas aparecerão aqui.</p>
        </div>

    @endforelse

</section>

<section class="dashboard-quick-actions">

    <h2>Acesso rápido</h2>

    <div class="dashboard-actions-grid">

        <a href="{{ route('bills.create') }}" class="dashboard-action-card">
            <strong>+ Nova conta</strong>
            <span>Cadastre um pagamento</span>
        </a>

        <a href="{{ route('recurrences.create') }}" class="dashboard-action-card">
            <strong>↻ Nova recorrência</strong>
            <span>Cadastre uma despesa periódica</span>
        </a>

        <a href="{{ route('bills.index') }}" class="dashboard-action-card">
            <strong>▤ Minhas contas</strong>
            <span>Consulte seus pagamentos</span>
        </a>

    </div>

</section>

@endsection
