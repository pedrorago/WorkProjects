<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tracker_id');
            $table->integer('project_id');
            $table->string('subject', 255);
            $table->longtext('description')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('status_id');
            $table->integer('assigned_to_id')->nullable();
            $table->integer('priority_id');
            $table->integer('fixed_version_id')->nullable();
            $table->integer('author_id');
            $table->integer('lock_version');
            $table->dateTime('created_on')->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->date('start_date')->nullable();
            $table->integer('done_ratio');
            $table->float('estimated_hours')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('root_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->tinyInteger('is_private');
            $table->dateTime('closed_on')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
