<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lembrete de vencimento</title>
</head>
<body style="margin: 0; padding: 30px; background: #f4f2f8; font-family: Arial, sans-serif; color: #222;">

    <div style="max-width: 520px; margin: auto; background: #ffffff; padding: 30px; border-radius: 12px;">

        <h1 style="color: #7c3aed;">LembrePay</h1>

        <h2>Olá! Não esqueça desta conta.</h2>

        <p>Estamos passando para lembrar que uma conta sua vence amanhã.</p>

        <div style="background: #f5f3ff; padding: 20px; border-radius: 8px; margin: 20px 0;">

            <p><strong>Conta:</strong> {{ $bill->title }}</p>

            <p>
                <strong>Valor:</strong>
                R$ {{ number_format((float) $bill->amount, 2, ',', '.') }}
            </p>

            <p>
                <strong>Vencimento:</strong>
                {{ $bill->due_date->format('d/m/Y') }}
            </p>

        </div>

        <p>Não deixe esse pagamento passar despercebido!</p>

        <p style="color: #888; font-size: 12px; margin-top: 30px;">
            Este é um aviso automático enviado pelo LembrePay.
        </p>

    </div>

</body>
</html>