<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStepTable extends Migration {

	public function up()
	{
		Schema::create('step', function(Blueprint $table) {
			$table->increments('id');
			$table->string('label', 255);
			$table->integer('cereals_group')->unsigned();
			$table->integer('min');
			$table->integer('max')->nullable();

			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('step');
	}
}