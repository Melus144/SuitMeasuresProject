<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measures', function (Blueprint $table) {
            $table->id();
            //customer id if logged in
            $table->foreignId('customer_id')
                ->nullable()
                ->default(null)
                ->constrained()
                ->nullOnDelete();
            //language of the customer
            $table->string('language')->default('en');

            //Portada inputs
            $table->string('name');
            $table->string('email');
            $table->decimal('height');
            $table->decimal('weight');
            $table->integer('age');
            $table->string('gender')->default('male');
            $table->boolean('have_marina_suit')->default(false);
            $table->string('marina_suit_size')->nullable();
            $table->boolean('rib_protector')->default(true);
            $table->string('suit_fitting');

            //Mesures comuns costillars (required)
            $table->decimal('shoulder');
            $table->decimal('sleeve_length');
            $table->decimal('sleeve_interior');
            $table->decimal('neck');
            $table->decimal('biceps');
            $table->decimal('forearm');

            $table->decimal('waist');
            $table->decimal('hip');
            $table->decimal('torso_length');
            $table->decimal('back_shot');
            $table->decimal('torso');
            $table->decimal('total_length');
            $table->decimal('leg');
            $table->decimal('interior_leg');
            $table->decimal('leg_upper');
            $table->decimal('leg_lower');
            $table->decimal('calf');

            //Mesures amb costillar (nullable)
            $table->decimal('rib_chest')->nullable();
            $table->decimal('rib_rack')->nullable();

            //Mesures sense costillar (nullable)
            $table->decimal('chest')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('measures');
    }
}
