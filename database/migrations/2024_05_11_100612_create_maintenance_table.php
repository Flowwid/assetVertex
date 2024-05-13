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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('condition');
            $table->text('description');
            $table->string('status');
            $table->string('division_id');
            $table->string('division_name');
            $table->string('asset_bom_id');
            $table->string('asset_bom_serial');
            $table->string('feedback_note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance');
    }
};
