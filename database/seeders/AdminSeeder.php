<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Client as MongoDBClient;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = new MongoDBClient(env('MONGODB_CONNECTION_STRING'));
        $collection = $client->selectCollection('admin_panel', 'users');

        $result = $collection->insertOne([
            'name' => 'Admin',
            'email' => 'admin@panel.com',
            'role_id' => 1,
            'password' => Hash::make('admin!@#'),
            'created_at' => new UTCDateTime(),
            'updated_at' => new UTCDateTime()
        ]);

        echo "Inserted with Object ID '{$result->getInsertedId()}'";
    }
}
