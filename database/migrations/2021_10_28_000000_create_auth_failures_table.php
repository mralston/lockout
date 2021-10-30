<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthFailuresTable extends Migration
{
    public function up()
    {
        Schema::create('auth_failures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->ipAddress('ip_address')->index();
            $table->string('user_agent');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_auth_failures');
    }
}
