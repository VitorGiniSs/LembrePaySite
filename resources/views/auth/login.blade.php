
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar | LembrePay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="auth-container">
        <section class="auth-card">
            <a href="/" class="brand">Lembre<span>Pay</span></a>

            <h1>Bem-vindo de volta</h1>
            <p class="auth-description">
                Entre na sua conta para continuar organizando suas finanças.
            </p>

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <label for="email">E-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="seu@email.com"
                    required
                    autofocus
                >
                @error('email')
                    <small>{{ $message }}</small>
                @enderror

                <label for="password">Senha</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Sua senha"
                    required
                >

                <button type="submit">Entrar na minha conta</button>
            </form>

            <p class="auth-footer">
                Ainda não possui uma conta?
                <a href="{{ route('register') }}">Criar conta</a>
            </p>
        </section>
    </main>
</body>
</html>
