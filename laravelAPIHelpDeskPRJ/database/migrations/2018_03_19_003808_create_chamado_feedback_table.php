<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChamadoFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamado_feedback', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('nome');
            $table->string('codigo', 50)->nullable();
            $table->unsignedTinyInteger('status')->default("1");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chamado_feedback');
    }
}
