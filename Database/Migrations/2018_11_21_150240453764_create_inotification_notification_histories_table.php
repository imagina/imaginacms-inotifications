<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInotificationNotificationHistoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('inotification__notification_histories', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');

      $table->integer('notification_id')->unsigned();
      $table->foreign('notification_id')
        ->references('id')
        ->on('inotification__notifications')
        ->onDelete('cascade');

      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')
        ->references('id')
        ->on('users')
        ->onDelete('cascade');

      $table->integer('platform_id')->unsigned();
      $table->foreign('platform_id')
        ->references('id')
        ->on('inotification__platforms')
        ->onDelete('cascade');

      $table->dateTime('viewed_at')->nullable();

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
    Schema::table('inotification__notification_histories', function (Blueprint $table) {
      $table->dropForeign([
        'notification_id',
        'user_id',
        'platform_id'
      ]);
    });
    Schema::dropIfExists('inotification__notification_histories');
  }
}
