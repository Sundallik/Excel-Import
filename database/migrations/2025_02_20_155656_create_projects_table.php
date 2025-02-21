<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('type_id')->index()->constrained('types');
            $table->string('title');
            $table->date('created_at_time');
            $table->boolean('is_chain')->nullable();
            $table->integer('worker_count')->nullable();
            $table->boolean('has_outsource')->nullable();
            $table->boolean('has_investors')->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('is_on_time')->nullable();
            $table->date('contracted_at');
            $table->integer('service_count')->nullable();
            $table->text('comment')->nullable();
            $table->decimal('effective_value')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
