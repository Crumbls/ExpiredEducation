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
        Schema::create('facts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content_old');
            $table->longText('content_new');
            $table->unsignedInteger('version')->default(1);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
            $table->datetime('started_at')->nullable();
            $table->datetime('ended_at')->nullable();
            $table->string('started_at_format')->default('Y');
            $table->string('ended_at_format')->default('Y');

            $table->foreign('parent_id')->references('id')->on('facts')->onDelete('cascade');
            $table->index(['parent_id', 'version']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facts');
    }
};
