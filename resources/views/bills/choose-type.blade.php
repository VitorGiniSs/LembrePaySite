```blade
@extends('layouts.app')

@section('title', 'Nova conta')
@section('breadcrumb', 'Minhas contas / Nova conta')
@section('page-title', 'Nova conta')

@section('content')
<a href="{{ route('bills.index') }}" class="back-menu-card">
    <span>←</span>
    Voltar para minhas contas
</a>

<div class="type-selection-intro">
    <h2>O que deseja cadastrar?</h2>
    <p>Escolha o tipo de compromisso financeiro que deseja acompanhar.</p>
</div>

<div class="bill-type-grid">

    <a href="{{ route('bills.create.avulsa') }}" class="bill-type-card">
        <div class="bill-type-icon avulsa-icon">↗</div>
        <div class="bill-type-content">
            <h3>Conta avulsa</h3>
            <p>Pagamentos únicos, como consultas, compras, multas ou consertos.</p>
            <span>Pagamento único</span>
        </div>
        <div class="bill-type-arrow">→</div>
    </a>

    <a href="{{ route('recurrences.create') }}" class="bill-type-card">
        <div class="bill-type-icon recorrente-icon">↻</div>
        <div class="bill-type-content">
            <h3>Conta recorrente</h3>
            <p>Despesas que se repetem, como água, luz, aluguel e condomínio.</p>
            <span>Sem data para terminar</span>
        </div>
        <div class="bill-type-arrow">→</div>
    </a>

    <a href="#" class="bill-type-card">
        <div class="bill-type-icon parcelamento-icon">▤</div>
        <div class="bill-type-content">
            <h3>Parcelamento</h3>
            <p>Compras divididas em parcelas, com acompanhamento do saldo restante.</p>
            <span>Controle de parcelas</span>
        </div>
        <div class="bill-type-arrow">→</div>
    </a>

    <a href="#" class="bill-type-card">
        <div class="bill-type-icon assinatura-icon">★</div>
        <div class="bill-type-content">
            <h3>Assinatura</h3>
            <p>Serviços como Netflix, Spotify, Amazon Prime e academia.</p>
            <span>Cobrança periódica</span>
        </div>
        <div class="bill-type-arrow">→</div>
    </a>

</div>

@endsection
```