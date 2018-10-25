<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('sales', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('customer_id');
      $table->enum('type', ['desayuno', 'almuerzo', 'cena']);
      $table->enum('entry', ['entrada', 'sopa']);
      $table->enum('option', ['opcion1', 'opcion2', 'ejecutivo', 'dieta']);
      $table->string('observation', 100)->nullable();
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
    Schema::dropIfExists('sales');
  }
}
