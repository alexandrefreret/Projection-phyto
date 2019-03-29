<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStepsTable extends Migration {

	public function up()
	{
		Schema::create('steps', function(Blueprint $table) {
			$table->increments('id');
			$table->string('label', 255);
			$table->integer('culture_id')->unsigned();
			$table->integer('step');

			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

			$table->foreign('culture_id')->references('id')->on('cultures');
		});
	}

	public function down()
	{
		Schema::drop('steps');
	}
}