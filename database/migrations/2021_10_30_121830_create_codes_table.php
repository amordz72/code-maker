<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->nullable()->defoult('empty');
            // $table->string('title_ar',255)->nullable()->defoult('فارغ');
            $table->text('code');
            $table->string('notes',500)->nullable()->defoult('No Code');
         $table->foreignId('user_id') ->constrained("users","id")->onDelete(null);
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
        Schema::dropIfExists('codes');
    }
}
