<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('step', function(Blueprint $table) {
			$table->foreign('cereals_group')->references('id')->on('cereals_group')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('step', function(Blueprint $table) {
			$table->dropForeign('step_cereals_group_foreign');
		});
	}
}