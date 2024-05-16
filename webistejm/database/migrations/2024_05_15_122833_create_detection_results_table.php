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
        Schema::create('detection_results', function (Blueprint $table) {
            $table->id('id_deteksi');
            $table->string('image_url');
            $table->string('latlong');
            $table->enum('is_valid', ['requested', 'accepted', 'declined']);
            $table->string('area');
            $table->string('validated_by');
            $table->integer('id_inspeksi');
            $table->integer('repair_progress');
            $table->string('fifty_pct_image_url')->nullable();
            $table->string('onehud_pct_image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detection_results');
    }
};
