<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->string('area');
            $table->integer('total_findings');
            $table->integer('verified_findings');
            $table->decimal('accuracy', 5, 2);
            $table->decimal('precision', 5, 2);
            $table->decimal('recall', 5, 2);
            $table->timestamps();
        });

        Schema::create('data_hasil_deteksi', function (Blueprint $table) {
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

        Schema::create('inspeksi', function (Blueprint $table) {
            $table->id('id_inspeksi');
            $table->integer('jumlah_pothole');
            $table->date('tanggal_inspeksi');
            $table->string('video_url');
            $table->string('area');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dashboards');
        Schema::dropIfExists('data_hasil_deteksi');
        Schema::dropIfExists('inspeksi');
    }
}
