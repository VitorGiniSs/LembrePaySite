
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova conta | LembrePay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="bills-page">

    <header class="bills-header">
        <div>
    <a href="{{ route('bills.create') }}" class="back-menu-card">
    <span>←</span>
    Voltar para tipos de conta
    </a>
            <h1>Nova conta</h1>
            <p>Cadastre um pagamento para acompanhar seu vencimento.</p>
        </div>
    </header>

    <section class="bills-card">
        <div class="bills-card-header">
            <h2>Informações do pagamento</h2>
        </div>

        <form action="{{ route('bills.store') }}" method="POST" class="bill-form">
            @csrf

            <div class="form-group">
                <label for="title">Descrição da conta</label>
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
                    <label for="due_date">Data de vencimento</label>
                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date') }}"
                        required
                    >
                    @error('due_date')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description">Observações (opcional)</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Adicione alguma informação sobre essa conta..."
                >{{ old('description') }}</textarea>
                @error('description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('bills.index') }}" class="cancel-button">
                    Cancelar
                </a>

                <button type="submit" class="primary-button">
                    Salvar conta
                </button>
            </div>

        </form>
    </section>

</div>

</body>
</html>
