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
   Schema::create('distributions', function (Blueprint $table) {
    $table->id(); // <- ini penting
    $table->foreignId('barista_id')->constrained('users');
    $table->integer('total_qty')->nullable();
    $table->decimal('estimated_result', 15, 2);
    $table->text('notes')->nullable();
    $table->foreignId('created_by')->constrained('users');
    $table->timestamps();
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distributions');
    }
};
