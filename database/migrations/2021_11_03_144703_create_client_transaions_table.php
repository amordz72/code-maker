<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTransaionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_transaions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tran_id')->constrained("transaion_types", "id");
            $table->foreignId('user_id')->constrained("users", "id");
            $table->foreignId('client_id')->constrained("clients", "id");
            $table->bigInteger("tran_in");
            $table->bigInteger("tran_out");

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
        Schema::dropIfExists('client_transaions');
    }
}