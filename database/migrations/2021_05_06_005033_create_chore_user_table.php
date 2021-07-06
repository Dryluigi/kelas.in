<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoreUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chore_user', function (Blueprint $table) {
            $table->foreignId('account_id')->constrained('accounts');
            $table->foreignId('class_id')->constrained('classes');
            $table->foreignId('chore_id')->constrained('chores');
            $table->foreignId('day_id')->nullable()->constrained('days');
            $table->time('jam')->nullable();
            $table->foreignId('chore_group_id')->constrained('chore_groups');
            $table->primary(['account_id', 'class_id', 'chore_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chore_user');
    }
}
