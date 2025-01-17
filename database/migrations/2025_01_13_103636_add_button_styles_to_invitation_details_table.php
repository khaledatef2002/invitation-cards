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
        Schema::table('invitation_details', function (Blueprint $table) {
            $table->string('button_color')->after('font_size_wide');
            $table->string('button_background')->after('button_color');
            $table->string('border_color')->after('button_background');
            $table->string('border_width')->after('border_color');
            $table->string('border_radius')->after('border_width'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invitation_details', function (Blueprint $table) {
            $table->dropColumn('button_background');
            $table->dropColumn('button_color');
            $table->dropColumn('border_color');
            $table->dropColumn('border_width');
            $table->dropColumn('border_radius');
        });
    }
};
