<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('trains', function (Blueprint $table) {
        $table->id();
        $table->string('nom')->nullable();
        $table->string('ligne')->nullable();
        $table->string('train_number');
        $table->decimal('current_lat', 10, 8);
        $table->decimal('current_lng', 11, 8);
        $table->string('status')->default('En route');
        $table->string('departure');
        $table->string('destination');
        $table->time('departure_time');
        $table->time('arrival_time');
        $table->integer('retard')->default(0);
        $table->json('route')->nullable(); // لتخزين مسار السكة
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
        Schema::dropIfExists('trains');
    }
};
