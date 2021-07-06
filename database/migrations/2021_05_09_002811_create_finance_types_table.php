<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_types', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('type');
            $table->primary('id');
        });

        DB::table('finance_types')->insert([
            'id' => 0,
            'type' => 'Pemasukan',
        ]);

        DB::table('finance_types')->insert([
            'id' => 1,
            'type' => 'Pengeluaran',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finance_types');
    }
}
