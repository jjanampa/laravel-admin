# laravel-admin
Laravel Admin is a drop-in admin panel package for Laravel which promotes rapid scaffolding & development.
* The project is based on the [Laravel Admin Panel](https://github.com/appzcoder/laravel-admin).
* This package has a modular approach, for which it uses the Laravel module, see the documentation for more information on this approach: https://github.com/nWidart/laravel-modules
* Installing this package will publish the `Admin` module in the `Modules` folder at the root of your project.
### Requirements
    Laravel >=7
    PHP >= 7.0

### Features:
1. Admin User, Role & Permission Manager:
2. Activity Log:
3. Page CRUD:
4. Settings:

#### Packages used:
- [Laravel-Modules](https://github.com/nWidart/laravel-modules)
- [Laravel UI](https://github.com/laravel/ui)
- [laravelCollective HTML](https://github.com/LaravelCollective/html)
- [Laravel-activitylog](https://github.com/spatie/laravel-activitylog)

#### Assets used:
- [Bootstrap 4](https://getbootstrap.com)
- [Material Dashboard](https://github.com/creativetimofficial/material-dashboard)
--------
## Installation
After initializing instance of Laravel
1. Run
    ```
    composer require jjanampa/laravel-admin
    ```

2. Install the admin package.
    ```
    php artisan laravel-admin:install
    ```
   > Service provider will be discovered automatically.
   
   > execute `php artisan laravel-admin:install --force` to force the installation, this process recreate the `Admin` module, removes and recreates the following tables:
   `admin_users, admin_roles, admin_permissions, admin_permission_role, admin_role_user, pages, settings`
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
   ```php
      'admin' => [
          'driver' => 'session',
          'provider' => 'admins',
       ],
   ```

    new config providers:
   ```php
        'admins' => [
            'driver' => 'eloquent',
            'model' => \Modules\Admin\Entities\AdminUser::class,
        ],
   ```
    new config passwords:
   ```php
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
   ```
### Logging In

Visit `(APP_URL)/admin` to access the admin panel.

The default admin login is:

    Email Address: admin@admin.com
    Password: secret

## Usage

1. Create some permissions.

2. Create some roles.

3. Assign permission(s) to role.

4. Create user(s) with role.

5. For checking authenticated user's role see below:

    ```php
    // Check role anywhere
    if (auth('admin')->user()->hasRole('editor')) {
        // Do admin stuff here
    } else {
        // Do nothing
    }

    // Check role in route middleware
   Route::resource('pages', 'Dashboard\PagesController')->middleware('role:editor');
    ```

6. For checking permissions see below:

    ```php
    if (auth('admin')->user()->can('permission-name')) {
        // Do something
    }
    ```

Learn more about ACL from [here](https://laravel.com/docs/master/authorization)

For activity log please read `spatie/laravel-activitylog` [docs](https://docs.spatie.be/laravel-activitylog/v2/introduction)
