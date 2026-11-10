```blade
@extends('layouts.app')

@section('title', 'Conta avulsa')
@section('breadcrumb', 'Minhas contas / Conta avulsa')
@section('page-title', 'Conta avulsa')

@section('content')

<div class="type-selection-intro">
    <h2>Qual é a situação dessa conta?</h2>
    <p>Escolha se essa despesa já foi paga ou se ainda precisa ser paga.</p>
</div>

<div class="bill-type-grid">

    <a href="#" class="bill-type-card">
        <div class="bill-type-icon avulsa-icon">
            <span>◷</span>
        </div>

        <div class="bill-type-content">
            <h3>Ainda vou pagar</h3>
            <p>Cadastre uma despesa pendente e acompanhe o vencimento para não esquecer.</p>
            <span>Conta pendente</span>
        </div>

        <div class="bill-type-arrow">→</div>
    </a>

    <a href="#" class="bill-type-card">
        <div class="bill-type-icon assinatura-icon">
            <span>✓</span>
        </div>

        <div class="bill-type-content">
            <h3>Já paguei</h3>
            <p>Registre uma despesa que já foi quitada. A data de pagamento será preenchida automaticamente.</p>
            <span>Conta paga</span>
        </div>

        <div class="bill-type-arrow">→</div>
    </a>

</div>

@endsection
```