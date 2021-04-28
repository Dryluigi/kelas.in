<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePostTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_types', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('type');
            $table->primary('id');
        });

        DB::table('post_types')->insert([
            'id' => 0,
            'type' => 'Umum'
        ]);

        DB::table('post_types')->insert([
            'id' => 1,
            'type' => 'Pengumuman'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_types');
    }
}
