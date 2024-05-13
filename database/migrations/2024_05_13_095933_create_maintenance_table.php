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
            $table->timestamps();
            $table->string('date');
            $table->string('description');
            $table->string('status');
            $table->unsignedBigInteger('asset_id');
            $table->string('asset_name');
            $table->unsignedBigInteger('bom_id');
            $table->string('bom_serial');
            $table->unsignedBigInteger('division_id');
            $table->string('division_name');

            $table->foreign('asset_id')->references('id')->on('asset')->onDelete('cascade');
            $table->foreign('bom_id')->references('id')->on('bom')->onDelete('cascade');
            $table->foreign('division_id')->references('id')->on('division')->onDelete('cascade');
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
