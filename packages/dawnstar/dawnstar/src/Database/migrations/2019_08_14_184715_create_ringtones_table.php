<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRingtonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ringtones', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', [1, 2, 3])->default(2);
            $table->integer('category_id');
            $table->string('type');
            $table->integer('credit')->default(0);
            $table->integer('download_count')->default(0);
            $table->string('name');
            $table->string('slug');
            $table->text('demo_file');
            $table->text('file');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_ringtones', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->integer('ringtone_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ringtones');
        Schema::dropIfExists('user_ringtones');
    }
}
