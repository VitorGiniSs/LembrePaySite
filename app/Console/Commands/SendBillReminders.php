<?php

namespace App\Console\Commands;

use App\Mail\BillReminderMail;
use App\Models\Bill;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendBillReminders extends Command
{
    protected $signature = 'bills:send-reminders';

    protected $description = 'Envia lembretes de contas que vencem amanhã';

    public function handle(): int
    {
        $bills = Bill::with('user.notificationChannels')
            ->whereDate('due_date', today()->addDay())
            ->where('status', 'pending')
            ->whereNull('reminder_sent_at')
            ->get();

        foreach ($bills as $bill) {

            $channels = $bill->user->notificationChannels
                ->where('type', 'email')
                ->where('is_active', true);

            if ($channels->isEmpty()) {
                continue;
            }

            foreach ($channels as $channel) {
                Mail::to($channel->destination)
                    ->send(new BillReminderMail($bill));
            }

            $bill->update([
                'reminder_sent_at' => now(),
            ]);

            $this->info("Lembrete enviado: {$bill->title}");
        }

        $this->info('Verificação de lembretes concluída.');

        return self::SUCCESS;
    }
}