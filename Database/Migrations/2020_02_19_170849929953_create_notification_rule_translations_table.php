<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationRuleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification__rule_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('rule_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['rule_id', 'locale']);
            $table->foreign('rule_id')->references('id')->on('notification__rules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notification__rule_translations', function (Blueprint $table) {
            $table->dropForeign(['rule_id']);
        });
        Schema::dropIfExists('notification__rule_translations');
    }
}
