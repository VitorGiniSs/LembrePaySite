
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('recurrence_id')
                ->nullable()
                ->constrained('recurrences')
                ->nullOnDelete();

            $table->foreignId('installment_plan_id')
                ->nullable()
                ->constrained('installment_plans')
                ->nullOnDelete();

            $table->string('title');

            $table->decimal('amount', 12, 2);

            $table->date('due_date');

            $table->enum('status', [
                'pending',
                'paid',
                'overdue',
            ])->default('pending');

            $table->dateTime('paid_at')->nullable();

            $table->text('description')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'due_date']);
            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
