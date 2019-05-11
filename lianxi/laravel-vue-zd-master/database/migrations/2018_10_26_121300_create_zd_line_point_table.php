<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdLinePointTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_line_point', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('line_id')->default(0)->comment('配送点ID');
			$table->integer('point_id')->default(0)->comment('排序');
			$table->integer('sort')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_line_point');
	}

}
