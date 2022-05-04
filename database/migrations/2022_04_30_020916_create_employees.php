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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role', 20)->nullable();
            $table->boolean('is_admin')->default(0);

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
                  
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('employees');
    }
};
