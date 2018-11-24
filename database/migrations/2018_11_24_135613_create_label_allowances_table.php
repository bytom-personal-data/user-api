<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_allowances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('accessor_hash');
            $table->boolean('is_active')->default(true);
            $table->smallInteger('mode')->default(\App\Models\LabelAllowance::READ_MODE);
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
        Schema::dropIfExists('label_allowances');
    }
}
