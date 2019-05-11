<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBaseClientActiveTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('base_client_active', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('date');
			$table->string('category_code', 50);
			$table->decimal('day_active', 10)->comment('日活');
			$table->decimal('week_active', 10)->comment('周活');
			$table->decimal('month_active', 10)->comment('月活');
			$table->unique(['date','category_code'], 'index_category_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('base_client_active');
	}

}
