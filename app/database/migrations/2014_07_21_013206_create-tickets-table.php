<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->increments('id_ticket');
			$table->integer('id_tienda');
			$table->string('nombre', 30);
			$table->string('apellido_paterno', 30);
			$table->string('apellido_materno', 30);
			$table->date('fecha');
			$table->integer('edad');
			$table->string('telefono', 30);
			$table->string('no_ticket', 30);
			$table->string('mail', 50);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tickets');
	}

}
