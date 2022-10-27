<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToBikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bikes', function (Blueprint $table) {
            //crea el campo para relacionar con la tabla users
            $table->unsignedBigInteger('user_id')->nullable()->after('imagen');

            //relaciona los dos campos
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bikes', function (Blueprint $table) {
            // deshace la relacción
            $table->dropForeign('bikes_user_id_foreign');
            // elimina la columna user_id
            $table->dropColumn('user_id');
        });
    }
}
