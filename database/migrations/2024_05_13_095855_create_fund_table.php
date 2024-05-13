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
        Schema::create('fund', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('used');
            $table->unsignedBigInteger('event_id');
            $table->string('event_name');
            $table->unsignedBigInteger('budget_id');
            $table->string('budget_name');

            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
            $table->foreign('budget_id')->references('id')->on('budget')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund');
    }
};
