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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->string('value')->nullable();
            $table->string('volume')->nullable();
            $table->foreignId('offers_id')
                  ->constrained('offers')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('shippers_id')
                  ->constrained('shippers')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('companys_id')
                  ->constrained('companies')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('bids');
    }
};
