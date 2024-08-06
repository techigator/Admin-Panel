<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://webimages.mongodb.com/_com_assets/cms/kuyjf3vea2hg34taa-horizontal_default_slate_blue.svg" width="400" alt="Laravel Logo"><p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p></a></p>

# Laravel With MongoDB Server Setup
This README provides a guide for setting up MongoDB with a Laravel project.

- **[Laravel]()**
- **[MongoDB]()**

Prerequisites
Laravel 11
PHP 8.2.0 (cli)
MongoDB Server
MongoDB PHP Extension
MongoDB Shell (optional)
Installation and Configuration
- Install MongoDB Server
- Install MongoDB PHP Extension
- Install MongoDB Driver


  ```
composer require mongodb/mongodb
  ```

Ensure the MongoDB extension is enabled in your PHP configuration (php.ini):
  ```
extension=mongodb
  ```

# Configure Laravel for MongoDB
Update Database Configuration
Update your .env file with your MongoDB database connection details:

```
MONGODB_CONNECTION=mongodb
MONGODB_HOST=cluster0.ctdbgu1.mongodb.net
MONGODB_PORT=27017
MONGODB_CONNECTION_STRING=your_connection_string
MONGODB_DATABASE=your_database
MONGODB_USERNAME=your_username
MONGODB_PASSWORD=your_password
MONGODB_AUTH_DATABASE=admin
```

Update config/database.php
Add a MongoDB connection configuration in the connections array:

```
'mongodb' => [
            'driver'   => 'mongodb',
            'dsn'      => env('MONGODB_CONNECTION_STRING'),
            'host'     => env('MONGODB_HOST', 'localhost'),
            'port'     => env('MONGODB_PORT', 27017),
            'database' => env('MONGODB_DATABASE', 'your_database'),
            'username' => env('MONGODB_USERNAME', 'your_username'),
            'password' => env('MONGODB_PASSWORD', 'your_password'),
            'options'  => [
                'database' => env('MONGODB_AUTH_DATABASE', 'admin'),
            ],
        ],   
  ```
# MongoDB Shell (mongosh)
- Download and Install MongoDB Shell
   Visit the MongoDB Shell Download Page and download the appropriate version for Windows.
   Install it in your preferred location.
- Add mongosh to System Path
   Navigate to the installation directory, e.g.,


  ```
C:\Users\YourUsername\AppData\Local\Programs\mongosh.
  ```
Copy the path.
Add it to the system's PATH environment variable:
  ```
Right-click on "This PC" or "Computer" on the desktop or in File Explorer.
Click "Properties" > "Advanced system settings".
Click "Environment Variables".
Under "System variables", find the Path variable and click "Edit".
Click "New" and paste the path.
  ```

## Running MongoDB Shell
Path to MongoDB Shell:
  ```
C:\Users\Usman Ghani\AppData\Local\Programs\mongosh\
  ```
Open a command prompt and type or check:
  ```
mongosh
  ```

To connect to MongoDB using the shell:
  ```
mongosh "mongodb+srv://username:password@cluster0.ctdbgu1.mongodb.net/database"
  ```

# Configuration
### MongoDB Configuration File
Create or edit a configuration file (mongod.conf) if you want to customize settings.

configuration file path:
  ```
C:\Program Files\MongoDB\Server\7.0\
  ```

Example configuration:
  ```
    systemLog:
      destination: file
      path: C:\Program Files\MongoDB\Server\7.0\log\mongod.log
      logAppend: true
    storage:
      dbPath: C:\Program Files\MongoDB\Server\7.
    security:
      authorization: "enabled"
  ```

### Start MongoDB with the configuration file:

Open Command Prompt With Administrator And
Run This Command:
  ```
net start MongoDB
  ```

# Migrations and Models
Use the Laravel MongoDB package if you need MongoDB-specific functionality in your migrations and models.

##### Install the package via Composer:

  ```
composer require mongodb/laravel-mongodb
  ```

## Migration

  ```
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
        Schema::connection('mongodb')->create('users', function (MongodbBlueprint $collection) {
            $collection->id();
            $collection->string('name');
            $collection->string('email')->unique();
            $collection->timestamp('email_verified_at')->nullable();
            $collection->string('password');
            $collection->rememberToken();
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mongodb')->drop('users');
    }
};
  ```
## Model

  ```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $connection = 'mongodb';
    protected string $collection = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
  ```

