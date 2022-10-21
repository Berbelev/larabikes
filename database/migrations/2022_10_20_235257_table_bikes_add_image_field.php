<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableBikesAddImageField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    {
        Schema::table('bikes', function(Blueprint $table){
            // crea el campo imagen en la tabla bikes
            $table->string('imagen', 255)
                   ->after('matriculada')
                   ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()    {
        Schema::table('bikes', function(Blueprint $table){
            $table->dropColumn('imagen');
        });
    }
}
