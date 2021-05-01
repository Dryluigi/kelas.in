<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('hari');
            $table->primary('id');
        });

        DB::table('days')->insert([
            'id' => 0,
            'hari' => 'Senin'
        ]);

        DB::table('days')->insert([
            'id' => 1,
            'hari' => 'Selasa'
        ]);
        DB::table('days')->insert([
            'id' => 2,
            'hari' => 'Rabu'
        ]);
        DB::table('days')->insert([
            'id' => 3,
            'hari' => 'Kamis'
        ]);
        DB::table('days')->insert([
            'id' => 4,
            'hari' => 'Jumat'
        ]);
        DB::table('days')->insert([
            'id' => 5,
            'hari' => 'Sabtu'
        ]);
        DB::table('days')->insert([
            'id' => 6,
            'hari' => 'Minggu'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days');
    }
}
