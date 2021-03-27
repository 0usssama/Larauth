1. Change user migration to
`php
  Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
             $table->string('password');
                });
`
2.add a dummy controller for testing purposes 
3.Remove the `prefix('api')`   in `boot()` method of the `app/Providers/RouteServiceProvider.php` file to get the correct response (without "api/")
4. Install laravel passport with this command: `composer require laravel/passport`
5. Run `php artisan passport:install` always after installing passport or droping the database
6. Configure passport by following the documentation 
7. edit `User.php` to match the migration columns
`php  protected $fillable = [ 'first_name', 'last_name', 'email', 'password',    ];
8. edit the `UserFactory.php` to match the migration columns
9. Create a `UsersTableSeeder` 
10.  Add `public $timestamps = false;`
11. Add ` $this->call(UsersTableSeeder::class); ` to `DatabaseSeeder.php`
12. Run `php artisan db:seed`
13. Create an auth controller .
