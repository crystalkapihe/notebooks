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
        Schema::create('arts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('art_id')
                ->constrained('arts');
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('sets');
            $table->string('name');
            $table->integer('sequence')
                ->nullable();
            $table->timestamps();
        });

        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('techniques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('set_id')
                ->nullable()
                ->constrained('sets');
            $table->foreignId('variation_parent_id')
                ->nullable()
                ->constrained('techniques');
            $table->text('description');
            $table->integer('sequence')
                ->nullable();
            $table->timestamps();
        });

        Schema::create('names', function (Blueprint $table) {
            $table->id();
            $table->foreignId('technique_id')
                ->constrained('techniques');
            $table->foreignId('language_id')
                ->constrained('languages');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('names');
        Schema::dropIfExists('techniques');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('sets');
        Schema::dropIfExists('arts');
    }
};
