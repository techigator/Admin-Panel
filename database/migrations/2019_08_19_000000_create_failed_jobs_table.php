<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use MongoDB\Laravel\Schema\Blueprint as MongodbBlueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('mongodb')->create('failed_jobs', function (MongodbBlueprint $collection) {
            $collection->id();
            $collection->string('uuid')->unique();
            $collection->text('connection');
            $collection->text('queue');
            $collection->longText('payload');
            $collection->longText('exception');
            $collection->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mongodb')->drop('failed_jobs');
    }
};
