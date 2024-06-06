<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('salons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('capacity');
            $table->decimal('price', 8, 2);
            $table->text('description')->nullable();
            $table->string('address');
            $table->text('owner')->nullable();
            $table->boolean('available')->default(true);
            $table->timestamps();
        });

        Schema::create('salon_images', function (Blueprint $table) {
            $table->id();
            $table->string('salon_id');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('salon_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        Schema::create('renta_salons', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('user_name');
            $table->string('user_last_name');
            $table->string('salon_id');
            $table->string('salon_name');
            $table->string('salon_price');
            $table->integer('meseros');
            $table->decimal('price', 8, 2);
            $table->integer('capacity');
            $table->integer('numero_de_horas');
            $table->date('fecha');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salons');
        Schema::dropIfExists('salons_imgs');
        Schema::dropIfExists('users');
        Schema::dropIfExists('renta_salons');
    }
};
