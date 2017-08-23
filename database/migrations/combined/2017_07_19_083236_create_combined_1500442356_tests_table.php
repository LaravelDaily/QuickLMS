<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1500442356TestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('tests')) {
            Schema::create('tests', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('course_id')->unsigned()->nullable();
                $table->foreign('course_id', '54422_596eeef514d00')->references('id')->on('courses')->onDelete('cascade');
                $table->integer('lesson_id')->unsigned()->nullable();
                $table->foreign('lesson_id', '54422_596eeef53411a')->references('id')->on('lessons')->onDelete('cascade');
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->tinyInteger('published')->nullable()->default(0);
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
