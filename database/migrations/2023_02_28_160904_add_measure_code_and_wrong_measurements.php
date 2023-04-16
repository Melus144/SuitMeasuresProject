<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMeasureCodeAndWrongMeasurements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('measures', function (Blueprint $table) {
            $table->string('measure_code')->nullable()->after('id');
            $table->json('wrong_measurements')->nullable();
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
            $table->dropColumn('measure_code');
            $table->dropColumn('wrong_measurements');
        });
    }
}
