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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->string('description')->nullable();
            $table->foreignIdFor(\App\Models\User::class);
            $table->string('ip_address');
            $table->integer('port');
            $table->string('additional_ports')->nullable();
            $table->string('memory');
            $table->string('disk');
            $table->softDeletes();
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
        Schema::dropIfExists('servers');
    }
};
