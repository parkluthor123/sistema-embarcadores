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
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('shippers_id')
                  ->nullable()
                  ->constrained('shippers')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('companys_id')
                  ->nullable()
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
        Schema::dropIfExists('affiliates');
    }
};
