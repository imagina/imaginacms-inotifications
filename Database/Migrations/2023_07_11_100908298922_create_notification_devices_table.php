<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationDevicesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('notification__devices', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your fields...
      $table->integer('user_id')->unsigned()->nullable();
      $table->foreign('user_id')->references('id')->on(config('auth.table', 'users'))->onDelete('restrict');
      $table->string("device")->nullable();
      $table->string("token");
      $table->integer('provider_id')->unsigned();
      $table->foreign('provider_id')->references('id')->on("notification__providers")->onDelete('restrict');
  
  
      // Audit fields
      $table->timestamps();
      $table->auditStamps();
    });
  }
  
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('notification__devices', function (Blueprint $table) {
      $table->dropForeign(['user_id']);
    });
  
    Schema::table('notification__devices', function (Blueprint $table) {
      $table->dropForeign(['provider_id']);
    });
    Schema::dropIfExists('notification__devices');
  }
}
