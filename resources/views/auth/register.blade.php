
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar conta | LembrePay</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="auth-container">
        <section class="auth-card">
            <a href="/" class="brand">Lembre<span>Pay</span></a>

            <h1>Crie sua conta</h1>
            <p class="auth-description">
                Organize suas contas e tenha controle do seu dinheiro.
            </p>

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <label for="name">Nome completo</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Seu nome"
                    required
                >
                @error('name')
                    <small>{{ $message }}</small>
                @enderror

                <label for="email">E-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="seu@email.com"
                    required
                >
                @error('email')
                    <small>{{ $message }}</small>
                @enderror

                <label for="password">Senha</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Mínimo de 8 caracteres"
                    required
                >
                @error('password')
                    <small>{{ $message }}</small>
                @enderror

                <label for="password_confirmation">Confirme sua senha</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Digite a senha novamente"
                    required
                >

                <button type="submit">Criar minha conta</button>
            </form>

            <p class="auth-footer">
                Já possui uma conta?
                <a href="{{ route('login') }}">Entrar</a>
            </p>
        </section>
    </main>
</body>
</html>
