<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInotificationNotificationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('inotification__notifications', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->integer('user_id')->unsigned();
      $table->text('message');
      $table->text('options')->nullable();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

      // Your fields
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
    Schema::table('inotification__notifications', function (Blueprint $table) {
      $table->dropForeign([
        'user_id'
      ]);
    });

    Schema::dropIfExists('inotification__notifications');
  }
}
