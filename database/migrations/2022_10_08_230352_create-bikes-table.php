<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikesTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //crea la tabla bikes
        Schema::create('bikes', function(Blueprint $table){
            // crea id como clave primaria
            $table->id();

            // crea marca, modelo, kilometros, precio y matriculada
            $table->string('marca', 255);
            $table->string('modelo',255);
            $table->integer('kms')->default(0);
            $table->float('precio')->default(0);
            $table->boolean('matriculada')->default(false);

            // crea marcas de tiempo: created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        //Rollback, deshacer la tabla bikes
        Schema::dorpIfExists('bikes');
    }
}
