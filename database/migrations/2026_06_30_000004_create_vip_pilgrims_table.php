<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vip_pilgrims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('registration_id');
            $table->string('pilgrim_name');
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->string('unique_code')->nullable();
            $table->string('contact_no')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();

            $table->foreign('registration_id')->references('id')->on('vip_registrations')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vip_pilgrims');
    }
};
