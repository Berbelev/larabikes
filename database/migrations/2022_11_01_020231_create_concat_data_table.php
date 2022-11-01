<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcatDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concat_data', function (Blueprint $table) {
            $table->id();
            $table->string('movil', 16);
            $table->string('fijo', 16);
            $table->string('direccion', 255);
            $table->unsignedBigInteger('user_id')->unique();
            $table->timestamps();

            //relaciona con la tabla usuario
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('concat_data', function (Blueprint $table) {
            // deshace la relacción
            $table->dropForeign('concat_data_user_id_foreign');
        });
        Schema::dropIfExists('concat_data');
    }
}
