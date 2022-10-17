<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableBikesAddFields extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    {
        // crear nuevos vampos matricula y color
        Schema::table('bikes', function(Blueprint $table){
            $table->string('matricula',7)
                  ->unique()
                  ->after('matriculada')
                  ->nullable();
            $table->string('color',7)
                  ->after('matricula')
                  ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()    {
        // eliminar los campos creados
        Schema::table('bikes', function(Blueprint $table){
            $table->dropColumn('matricula');
            $table->dropColumn('color');
            
        });    
    }
}
