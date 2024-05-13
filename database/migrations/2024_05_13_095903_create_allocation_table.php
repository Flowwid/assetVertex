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
        Schema::create('allocation', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('event_id');
            $table->string('event_name');
            $table->unsignedBigInteger('division_id');
            $table->string('division_name');

            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
            $table->foreign('division_id')->references('id')->on('division')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocation');
    }
};
