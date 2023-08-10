<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rate_limits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on("users")->onDelete('cascade');
            $table->string('traffic_landing')->nullable()->index();  
            $table->string('domain')->nullable()->index();
            $table->string('prev_link')->nullable()->index();

            $table->string('ip')->index();

            $table->string('agent_name')->nullable()->index();
            $table->string('browser')->nullable()->index();
            $table->string('device')->nullable()->index();
            $table->string('operating_system')->nullable()->index();

            $table->string('code')->nullable()->index(); 
            $table->string('country_code')->nullable()->index();
            $table->string('country_name')->nullable()->index();  
            $table->text('query')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_limits');
    }
};
