<?php

use App\Models\User;
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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            

            $table->foreignIdFor(User::class);
            $table->string('address');
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->time('open_time')->nullable();
            $table->time('close_time')->nullable();
            $table->integer('capacity');
            $table->string('manager_name');
            


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
