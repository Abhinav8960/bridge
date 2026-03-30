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
        Schema::create('call_to_actions', function (Blueprint $table) {
            $table->id();
            $table->integer('call_to_action_type');
            $table->string('specify_value');
            $table->string('specify_icon');
            $table->tinyInteger('is_showin_header')->default(0);
            $table->tinyInteger('is_showin_footer')->default(0);
            $table->tinyInteger('is_showin_contact_page')->default(0);
            $table->tinyInteger('is_showin_mobile_app')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->blameable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->dateTime('created_at', $precision = 0);
            $table->dateTime('updated_at', $precision = 0);
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
        Schema::dropIfExists('call_to_actions');
    }
};
