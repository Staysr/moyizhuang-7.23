<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarInsuranceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_insurance', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('number', 50)->comment('保险单号');
			$table->integer('insurance_company_id')->comment('保险公司ID:car_insurance_company.id');
			$table->integer('company_id')->comment('当前外包公司:sys_car_company.id');
			$table->integer('car_id')->comment('车辆ID：sys_car.id');
			$table->boolean('type')->comment('保险类型：1,交强险；2,商业险; 3,车船税;');
			$table->date('start_date')->comment('开始时间');
			$table->date('end_date');
			$table->decimal('cost', 10)->nullable()->comment('保险金额');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('car_insurance');
	}

}
