
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar conta | LembrePay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="bills-page">

    <header class="bills-header">
        <div>
            <a href="{{ route('bills.index') }}" class="back-link">
                ← Voltar para minhas contas
            </a>
            <h1>Editar conta</h1>
            <p>Atualize as informações deste pagamento.</p>
        </div>
    </header>

    <section class="bills-card">
        <div class="bills-card-header">
            <h2>Informações do pagamento</h2>
        </div>

        <form action="{{ route('bills.update', $bill->id) }}"
              method="POST"
              class="bill-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Descrição da conta</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $bill->title) }}"
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
                        value="{{ old('amount', $bill->amount) }}"
                        step="0.01"
                        min="0.01"
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
                        value="{{ old('due_date', $bill->due_date->format('Y-m-d')) }}"
                        required
                    >
                    @error('due_date')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="status">Status do pagamento</label>
                <select id="status" name="status" required>
                    <option value="pending" @selected(old('status', $bill->status) === 'pending')>
                        Pendente
                    </option>
                    <option value="paid" @selected(old('status', $bill->status) === 'paid')>
                        Paga
                    </option>
                    <option value="overdue" @selected(old('status', $bill->status) === 'overdue')>
                        Atrasada
                    </option>
                </select>
                @error('status')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Observações (opcional)</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Informações adicionais sobre essa conta..."
                >{{ old('description', $bill->description) }}</textarea>
                @error('description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('bills.index') }}" class="cancel-button">
                    Cancelar
                </a>

                <button type="submit" class="primary-button">
                    Salvar alterações
                </button>
            </div>

        </form>
    </section>

</div>

</body>
</html>
