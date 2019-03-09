<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCerealsGroupTable extends Migration {

	public function up()
	{
		Schema::create('cereals_group', function(Blueprint $table) {
			$table->increments('id');
			$table->string('label', 255);
			$table->string('externid');

			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}

	public function down()
	{
		Schema::drop('cereals_group');
	}
}