<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
     {
        //  Schema::table('konselings', function (Blueprint $table) {
        //      $table->string('status')->default('pending'); // default pending
        //  });
    }

     public function down(): void
     {
         Schema::table('konselings', function (Blueprint $table) {
             $table->dropColumn('status');
        });
     }
};
