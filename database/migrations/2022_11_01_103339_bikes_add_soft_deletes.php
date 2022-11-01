<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BikesAddSoftDeletes extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    {
        Schema::table('bikes', function(Blueprint $table){
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()    {
        Schema::table('bikes', function(Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
}
