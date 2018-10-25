<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('customers', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name', 30);
      $table->string('father_surname', 30);
      $table->string('mother_surname', 30);
      $table->char('dni', 8);
      $table->integer('business_id');
      $table->integer('office_id');
      $table->integer('job_id');
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
    Schema::dropIfExists('customers');
  }
}
