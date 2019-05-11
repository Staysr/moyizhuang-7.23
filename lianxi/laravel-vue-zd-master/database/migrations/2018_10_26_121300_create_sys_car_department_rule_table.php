<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarDepartmentRuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_department_rule', function(Blueprint $table)
		{
			$table->integer('car_department_id');
			$table->integer('car_rule_id')->index('car_role_rule_rule_id');
			$table->unique(['car_department_id','car_rule_id'], 'fu');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_car_department_rule');
	}

}
