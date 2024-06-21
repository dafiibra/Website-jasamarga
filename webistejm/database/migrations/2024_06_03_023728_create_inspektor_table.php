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
        Schema::create('inspektor', function (Blueprint $table) {
            $table->string('username');
            $table->string('password');
            $table->string('fullname');
            $table->string('email');
            $table->string('division');
            $table->string('status');
            $table->string('accepted_by');
            $table->timestamp('accepted_timestamp')->nullable();
            $table->string('rejected_by');
            $table->timestamp('rejected_timestamp')->nullable();
            $table->string('deleted_by');
            $table->timestamp('deleted_timestamp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
