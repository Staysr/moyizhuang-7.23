<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMycatSequenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mycat_sequence', function(Blueprint $table)
		{
			$table->string('NAME', 50)->primary();
			$table->integer('current_value');
			$table->integer('increment')->default(100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mycat_sequence');
	}

}
