<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DireccionTiendas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tiendas', function($table)
        {
            $table->text('direccion');
            $table->string('latitid', 20);
            $table->string('longitud', 20);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tiendas', function($table)
        {
            $table->dropColumn('direccion');
            $table->dropColumn('latitid');
            $table->dropColumn('longitud');
        });
	}

}
