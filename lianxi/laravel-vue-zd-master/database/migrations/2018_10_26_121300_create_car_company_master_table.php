<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarCompanyMasterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_company_master', function(Blueprint $table)
		{
			$table->integer('master_id')->unsigned();
			$table->integer('company_id')->unsigned()->index('group_user_group_id_foreign');
			$table->primary(['master_id','company_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('car_company_master');
	}

}
