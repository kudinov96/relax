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
        Schema::create('logs_chairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("chair_id")->constrained("chairs")->cascadeOnDelete();
            $table->foreignId("order_id")->constrained("orders")->cascadeOnDelete();
            $table->text("request");
            $table->text("response");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs_chairs');
    }
};
