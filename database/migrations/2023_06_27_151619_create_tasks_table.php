<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->foreign('chat_id')->references('id')->on('chats')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('task_to_user_id');
            $table->foreign('task_to_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('content', 300);
            $table->string('task_priority');
            $table->boolean('is_done')->default(false);;
            $table->timestamps();
        });
        DB::statement("ALTER TABLE tasks MODIFY COLUMN task_priority ENUM('High priority', 'Middle priority', 'Low priority')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
