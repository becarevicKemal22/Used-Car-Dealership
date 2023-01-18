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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->decimal('price');
            $table->year('production_year');
            $table->integer('kilometers');
            $table->string('engine_type');
            $table->string('chassis_type');
            $table->string('gearbox');
            $table->string('color', 16);
            $table->string('door_number', 8)->nullable();
            $table->string('engine_volume', 4);
            $table->integer('engine_strength');
            $table->string('drive', 16)->nullable();
            $table->text('opis');
            if(config('app.env') == 'testing'){
                $table->text('oprema')->nullable()->default("");
            }else{    
                $table->text('oprema');
            }
            $table->unsignedBigInteger('vehicle_model_id')->index()->nullable();
            $table->foreign('vehicle_model_id')->references('id')->on('vehicle_models')->onDelete('set null');

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
        Schema::dropIfExists('vehicles');
    }
};
