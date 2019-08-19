<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCultureProduitStepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('culture_produit_step', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('produit_step_id')->unsigned();
            $table->integer('culture_produit_id')->unsigned();

            
            
            $table->integer('delai')->default(0);
            $table->integer('delai_bbch')->default(0);
            $table->decimal('dose', 8, 2);
            $table->string('dose_unite', 20);
            $table->integer('nb_application_max')->nullable()->default(null);
            $table->string('etat', 255);
            $table->date('date_fin_distribution');
            $table->date('date_fin_utilisation');
            $table->text('condition_emploi');
            $table->string('znt_aquatique', 255);
            $table->string('znt_arthropodes', 255);
            $table->string('znt_plantes', 255);


            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('culture_produit_id')->references('id')->on('culture_produit');
            $table->foreign('produit_step_id')->references('id')->on('produit_step');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('culture_produit_step');
    }
}
