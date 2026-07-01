<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vip_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('group_name')->nullable();
            $table->string('mobile_number');
            $table->string('email')->nullable();
            $table->string('service_name');
            $table->decimal('seva_amount', 10, 2)->default(0);
            $table->integer('no_of_free_laddus')->default(0);
            $table->decimal('hundi_offering', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('payment_mode')->nullable();
            $table->dateTime('tr_date_time')->nullable();
            $table->string('payment_status')->default('pending');
            $table->string('booking_status')->default('submitted');
            $table->string('screen_short')->nullable();
            $table->string('utr_number')->nullable();
            $table->string('slot')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vip_registrations');
    }
};
