<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSysCarDepartmentRuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sys_car_department_rule', function(Blueprint $table)
		{
			$table->foreign('car_department_id', 'sys_car_department_rule_ibfk_1')->references('id')->on('sys_car_department')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('car_rule_id', 'sys_car_department_rule_ibfk_2')->references('id')->on('sys_car_rule')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sys_car_department_rule', function(Blueprint $table)
		{
			$table->dropForeign('sys_car_department_rule_ibfk_1');
			$table->dropForeign('sys_car_department_rule_ibfk_2');
		});
	}

}
