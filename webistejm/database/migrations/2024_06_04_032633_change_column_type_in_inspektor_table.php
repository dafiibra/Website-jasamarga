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
        Schema::table('inspektor', function (Blueprint $table) {
            $table->string('fullname')->change();
            $table->string('division')->change();
            $table->string('status')->change();
            $table->string('accepted_by')->change();
            $table->string('rejected_by')->change();
            $table->string('deleted_by')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inspektor', function (Blueprint $table) {
            $table->integer('fullname')->change();
            $table->integer('division')->change();
            $table->integer('status')->change();
            $table->integer('accepted_by')->change();
            $table->integer('rejected_by')->change();
            $table->integer('deleted_by')->change();
        });
    }
};
