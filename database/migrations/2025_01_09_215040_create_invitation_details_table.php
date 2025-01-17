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
        Schema::create('invitation_details', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('title');
            $table->text('description');
            $table->string('long');
            $table->string('wide');
            $table->string('background');
            $table->float('x_long');
            $table->float('y_long');
            $table->float('font_size_long');
            $table->float('x_wide');
            $table->float('y_wide');
            $table->float('font_size_wide');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation_details');
    }
};
