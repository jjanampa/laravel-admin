
# laravel-admin
Laravel Admin is a drop-in admin panel package for Laravel which promotes rapid scaffolding & development, uses [Material Dashboard](https://www.creative-tim.com/product/material-dashboard-laravel)
* The project is based on the [Laravel Admin Panel](https://github.com/appzcoder/laravel-admin) and [Material Dashboard Laravel](https://github.com/creativetimofficial/material-dashboard-laravel).
* This package has a modular approach, for which it uses the Laravel module, see the documentation for more information on this approach: https://github.com/nWidart/laravel-modules
* Installing this package will publish the `Admin` module in the `Modules` folder at the root of your project.
  

  ![Dashboard](https://user-images.githubusercontent.com/1957176/103500880-7e4ca300-4e1a-11eb-9ac6-77e052d71033.png)
### Requirements
    Laravel >=7
    PHP >= 7.0

### Features:
1. Admin User, Role & Permission Manager:
2. Activity Log:
3. Page CRUD:
4. Settings:
5. Login, Forgot Password
6. Profile

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
1. Autoloading: By default, module classes are not loaded automatically. You can autoload your modules using `psr-4`, add `"Modules\\": "Modules/"` in
   **composer.json**.
   ``` json
   {
     "autoload": {
       "psr-4": {
         "App\\": "app/",
         "Modules\\": "Modules/",
       }
     }
   }
   ```

   **Tip: don't forget to run `composer dump-autoload` afterwards.**
2. Run
    ```
    composer require jjanampa/laravel-admin
    ```

3. Install the admin package.
    ```
    php artisan laravel-admin:install
    ```
   > Service provider will be discovered automatically.
   
   > execute `php artisan laravel-admin:install --force` to force the installation, this process recreate the `Admin` module, removes and recreates the following tables:
   `admin_users, admin_roles, admin_permissions, admin_permission_role, admin_role_user, pages, settings`
   
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
## Screenshots
| Admin Users | Admin Roles | Admin Permissions |
| --- | --- | ---  |
| ![Admin Users](https://user-images.githubusercontent.com/1957176/103501360-f36ca800-4e1b-11eb-91b3-ea9995aa9759.png)  | ![Admin Roles](https://user-images.githubusercontent.com/1957176/103501366-f4053e80-4e1b-11eb-9e7b-e9ccdea6ebf1.png)  | ![Admin Permissions](https://user-images.githubusercontent.com/1957176/103501367-f49dd500-4e1b-11eb-8025-302af1fb1709.png)
| Pages | Activity Log | Settings |
| ![Pages](https://user-images.githubusercontent.com/1957176/103501368-f49dd500-4e1b-11eb-93fd-d0189b1c56e3.png)  | ![Activity Log](https://user-images.githubusercontent.com/1957176/103501370-f5366b80-4e1b-11eb-9326-9f6d66e23531.png) | ![Settings](https://user-images.githubusercontent.com/1957176/103501371-f5366b80-4e1b-11eb-8238-15db7a9ec133.png)
| Profile | Login| Forgot Password |
| ![Profile](https://user-images.githubusercontent.com/1957176/103501372-f5cf0200-4e1b-11eb-8f33-ee9f7975e42e.png)  | ![Login](https://user-images.githubusercontent.com/1957176/103501373-f6679880-4e1b-11eb-89ca-b12f36ed4ea4.png) | ![Forgot Password](https://user-images.githubusercontent.com/1957176/103501374-f7002f00-4e1b-11eb-89e4-2cbd572bfa53.png)
