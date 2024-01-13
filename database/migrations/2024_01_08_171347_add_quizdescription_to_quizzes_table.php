<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->text('Quizdescription')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn('Quizdescription');
        });
    }
};
