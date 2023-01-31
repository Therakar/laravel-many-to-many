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
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('type_id')->nullable()->constrained()->onDelete('set null'); //l'utente decide se assegnare o no un type al project | se il project ha una categoria e viene cancellato il type diventa null.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            //oppure $table->dropForeign('projects_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
};
