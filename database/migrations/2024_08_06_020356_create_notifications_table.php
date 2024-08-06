<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint as MongodbBlueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('mongodb')->create('notifications', function (MongodbBlueprint $collection) {
            $collection->uuid('id')->primary();
            $collection->string('type');
            $collection->morphs('notifiable');
            $collection->text('data');
            $collection->timestamp('read_at')->nullable();
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mongodb')->drop('notifications');
    }
};
