<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnInAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administrators', function (Blueprint $table) {
            $table->renameColumn('userid', 'administrator_id');
            $table->renameColumn('userid_verified_at', 'administrator_id_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('administrators', function (Blueprint $table) {
            $table->renameColumn('administrator_id', 'userid');
            $table->renameColumn('administrator_id_verified_at', 'userid_verified_at');

        });
    }
}
