<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi')->nullable();
            $table->foreignId('post_type_id')->constrained('post_types');
            $table->foreignId('class_id')->constrained('classes');
            $table->foreignId('user_id')->nullable()->constrained('accounts');
            $table->foreignId('post_folder_id')->nullable()->constrained('post_folders');            
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
        Schema::dropIfExists('posts');
    }
}
