# laravel-admin
Laravel admin dashboard
### Features:
##### 1. Admin User, Role & Permission Manager:
Easy user Management with features like Roles, Permission and Access Control.
##### 2. Activity Log:

##### 3. Page CRUD:

##### 4. Settings:

--------
## Installation

1. Run
    ```
    composer require jjanampa/laravel-admin
    ```

2. Install the admin package.
    ```
    php artisan laravel-admin:install
    ```
   > Service provider will be discovered automatically.
3. Autoloading: By default, module classes are not loaded automatically. You can autoload your modules using `psr-4` in
   composer.json.
``` json
{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "Modules\\": "Modules/"
    }
  }
}
```

**Tip: don't forget to run `composer dump-autoload` afterwards.**

4. add config from admin in config/auth.php
   
    new config guard:
   ```
      'admin' => [
       'driver' => 'session',
       'provider' => 'admins',
       ],
   ```

    new config providers:
   ```
        'admins' => [
            'driver' => 'eloquent',
            'model' => \Modules\Admin\Entities\AdminUser::class,
        ],
   ```
    new config passwords:
   ```
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
   ```

