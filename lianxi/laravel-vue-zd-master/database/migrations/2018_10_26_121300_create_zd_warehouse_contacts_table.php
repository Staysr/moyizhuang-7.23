<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZdWarehouseContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zd_warehouse_contacts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('warehouse_id');
			$table->string('name')->nullable()->comment('备用联系人姓名');
			$table->string('phone')->nullable()->comment('备用联系人电话');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zd_warehouse_contacts');
	}

}
