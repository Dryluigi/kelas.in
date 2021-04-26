<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_account', function (Blueprint $table) {
            $table->foreignId('account_id')->constrained('accounts');
            $table->foreignId('class_id')->constrained('classes');
            $table->string('nomor_induk')->nullable();
            $table->integer('nomor_presensi')->nullable();
            $table->foreignId('role_id')->constrained('class_member_roles');
            $table->timestamps();
            $table->primary(['account_id', 'class_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_account');
    }
}
