<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('prescriptions', function (Blueprint $table) {
        $table->id();
        $table->string('pat_name'); 
        $table->string('user_number'); 
        $table->text('signs_and_symptoms');
        $table->text('medicine');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
