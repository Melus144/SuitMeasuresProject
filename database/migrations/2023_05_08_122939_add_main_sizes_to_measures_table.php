<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMainSizesToMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('measures', function (Blueprint $table) {
            $table->unsignedInteger('height_size')->nullable()->after('suit_fitting');
            $table->unsignedInteger('weight_size')->nullable()->after('height_size');
            $table->unsignedInteger('chest_size')->nullable()->after('weight_size');
            $table->unsignedInteger('waist_size')->nullable()->after('chest_size');
            $table->unsignedInteger('hip_size')->nullable()->after('waist_size');
            $table->unsignedInteger('medium_size')->nullable()->after('hip_size');
            $table->string('final_size')->nullable()->after('medium_size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('measures', function (Blueprint $table) {
            $table->dropColumn('height_size');
            $table->dropColumn('weight_size');
            $table->dropColumn('chest_size');
            $table->dropColumn('waist_size');
            $table->dropColumn('hip_size');
            $table->dropColumn('medium_size');
            $table->dropColumn('final_size');
        });
    }
}
