<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiendasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiendas', function (Blueprint $table)
        {
            $table->increments('id_tienda'); 
            $table->string('clave', 30); 
            $table->string('cadena',30); 
            $table->string('nombre_tienda', 30); 
            $table->string('estado_tienda', 30); 
            $table->string('municipio_tienda', 30); 
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
