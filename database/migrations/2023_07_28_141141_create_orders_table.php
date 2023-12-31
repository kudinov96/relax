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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid("chair_id")->constrained("chairs")->cascadeOnDelete();
            $table->integer("minutes");
            $table->integer("costs");
            $table->text("response")->nullable();
            $table->boolean("success_run_chair")->default(false);
            $table->boolean("success_payment")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
