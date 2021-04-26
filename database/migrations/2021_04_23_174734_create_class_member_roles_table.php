<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateClassMemberRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_member_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('role');
            $table->primary('id');
        });

        DB::table('class_member_roles')->insert([
            'id' => 0,
            'role' => 'Ketua'
        ]);

        DB::table('class_member_roles')->insert([
            'id' => 1,
            'role' => 'Anggota'
        ]);
        DB::table('class_member_roles')->insert([
            'id' => 2,
            'role' => 'Sekretaris'
        ]);
        DB::table('class_member_roles')->insert([
            'id' => 3,
            'role' => 'Bendahara'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_member_roles');
    }
}
