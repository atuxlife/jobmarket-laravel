<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('document_type', ['CC', 'CE', 'PS'])->default('CC'); // (CC)Cédula ciudadanía, (CE)Cédula extranjería, (PS)Pasaporte
            $table->integer('document');
            $table->enum('role', ['A', 'U'])->default('U'); // (A)dmin, (U)ser
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('document_type');
            $table->dropColumn('document');
            $table->dropColumn('role');
        });
    }
};
