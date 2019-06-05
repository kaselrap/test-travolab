<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsCoastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_coast', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('event_id')->index();
            $table->float('coast_less_five_spec')->nullable();
            $table->float('coast_less_five_other')->nullable();
            $table->float('coast_more_five_spec')->nullable();
            $table->float('coast_more_five_other')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events_coast');
    }
}
