<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysCarTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_car_type', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 32)->comment('车型名称');
			$table->string('code', 20)->comment('code');
			$table->integer('capacity')->comment('载重');
			$table->float('length', 10)->default(0.00)->comment('长');
			$table->float('width', 10)->default(0.00)->comment('宽');
			$table->float('height', 10)->default(0.00)->comment('高');
			$table->string('remark')->nullable()->comment('简单说明');
			$table->string('icon')->nullable()->comment('车型图标');
			$table->string('spec')->nullable()->comment('车型规格。例：带拖车,带尾板,司机人好。最多六个');
			$table->integer('is_join')->nullable()->default(1)->comment('是否允许加盟：0 不允许 1 允许加盟');
			$table->dateTime('create_time')->nullable();
			$table->dateTime('modify_time')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_car_type');
	}

}
