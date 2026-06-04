<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('valeur_options', function (Blueprint $table) {
            $table->string('image_calque')->nullable()->after('valeur');
            $table->integer('ordre_calque')->default(0)->after('image_calque');
        });
    }

    public function down()
    {
        Schema::table('valeur_options', function (Blueprint $table) {
            $table->dropColumn(['image_calque', 'ordre_calque']);
        });
    }
};