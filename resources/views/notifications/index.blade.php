
@extends('layouts.app')

@section('title', 'Notificações')
@section('breadcrumb', 'Preferências / Notificações')
@section('page-title', 'Central de Notificações')

@section('content')

<section class="welcome-section">
    <div>
        <h2>Seus avisos, do seu jeito.</h2>
        <p>Escolha onde deseja receber lembretes das suas contas.</p>
    </div>
</section>

<section class="notification-intro">
    <h3>Canais de notificação</h3>
    <p>Conecte os canais que deseja utilizar para receber seus lembretes.</p>
</section>

<section class="notification-grid">

    <article class="notification-card email-card">
        <div class="channel-icon">✉</div>
    <div class="channel-info">
<div class="channel-title">
    <h3>E-mail</h3>
    <span class="channel-status">Disponível</span>
</div>
    <p>Receba lembretes diretamente na sua caixa de entrada.</p>

    @forelse($channels->where('type', 'email') as $channel)
<div class="registered-channel">

    <div class="registered-channel-header">
        <strong>{{ $channel->destination }}</strong>

        <span class="channel-status-indicator {{ $channel->is_active ? 'active' : 'inactive' }}">
            <span class="status-dot"></span>
            {{ $channel->is_active ? 'Ativo' : 'Desativado' }}
        </span>
    </div>

    <div class="registered-channel-actions">

        <a href="{{ route('notifications.edit', $channel->id) }}"
           class="channel-action-button">
            Editar
        </a>

        <form action="{{ route('notifications.toggle', $channel->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <button type="submit" class="channel-action-button">
                {{ $channel->is_active ? 'Desativar' : 'Ativar' }}
            </button>
        </form>
<form
    action="{{ route('notifications.destroy', $channel->id) }}"
    method="POST"
    onsubmit="return confirm('Tem certeza que deseja excluir este e-mail?')"
>
    @csrf
    @method('DELETE')

    <button type="submit" class="channel-action-button delete-button">
        Excluir
    </button>
</form>
    </div>
</div>
    @empty
        <p>Nenhum e-mail cadastrado.</p>
    @endforelse
    </div>

<a href="{{ route('notifications.create') }}" class="channel-button">
    Configurar e-mail
</a>
    </article>

    <article class="notification-card whatsapp-card">
        <div class="channel-icon">◉</div>
        <div class="channel-info">
            <h3>WhatsApp</h3>
            <p>Receba avisos diretamente no seu WhatsApp.</p>
        </div>
        <span class="channel-status coming-soon">Em breve</span>
        <button type="button" class="channel-button" disabled>
            Em breve
        </button>
    </article>

    <article class="notification-card telegram-card">
        <div class="channel-icon">➤</div>
        <div class="channel-info">
            <h3>Telegram</h3>
            <p>Receba notificações através de um bot.</p>
        </div>
        <span class="channel-status coming-soon">Em breve</span>
        <button type="button" class="channel-button" disabled>
            Em breve
        </button>
    </article>

</section>

@endsection
