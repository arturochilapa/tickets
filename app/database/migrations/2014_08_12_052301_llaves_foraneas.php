<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LlavesForaneas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	   /*	   
		Schema::table('tickets', function($table)
        {
            $table->foreign('id_tienda')->references('id_tienda')->on('tiendas');
        });
        */        
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        /*	   
		Schema::table('tickets', function($table)
        {
            $table->dropForeign('posts_user_id_foreign');
                      
        });
        */        
	}

}
