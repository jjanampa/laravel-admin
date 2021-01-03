<?php

namespace Jjanampa\LaravelAdmin;

use App;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Process\Process;

class LaravelAdminCommand extends Command
{
    const PUBLISHSPATH = __DIR__.'/../publish/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-admin:install {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Laravel Admin.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function getModulePath()
    {
        return base_path('Modules/Admin');;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $force = $this->option('force');

        if ($force) {
            $this->cleanModule();
        } elseif ((new Filesystem)->isDirectory($this->getModulePath()) ) {
            $this->error('Module [Admin] already exist!');
            exit();
        }

        try {
            $this->call('migrate');
        } catch (QueryException $e) {
            $this->error($e->getMessage());
            exit();
        }

        $this->info("Generating the authentication scaffolding");
        $this->publishModule();
        $this->updateAssets();

        $this->info("Dumping the composer autoload");
        (new Process(['composer dump-autoload']))->run();

        $this->migrate();


        $this->info("Successfully installed Laravel Admin!");
    }

    protected function cleanModule()
    {
        (new Filesystem)->deleteDirectory($this->getModulePath());
        Schema::dropIfExists('admin_permission_role');
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_role_user');
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('settings');
    }

    /**
     * publishModule
     *
     * @return void
     */
    protected function publishModule()
    {
        $this->info("Publishing the module Admin");

        $this->call('module:make', ['name' => ['Admin']]);
        (new Filesystem)->deleteDirectory($this->getModulePath());
        static::copyDirectory('Admin', $this->getModulePath());
    }

    /**
     * Update the assets
     *
     * @return void
     */
    protected function updateAssets()
    {
        $this->info("Publishing the assets");
        if (!(new Filesystem)->isDirectory(public_path('css')))
        {
            (new Filesystem)->makeDirectory(public_path('css'));
        }
        if (!(new Filesystem)->isDirectory(public_path('js')))
        {
            (new Filesystem)->makeDirectory(public_path('js'));
        }

        static::copyFile('public/css/admin.css', public_path('css/admin.css'));
        static::copyFile('public/js/admin.js', public_path('js/admin.js'));
        static::copyDirectory('public/material', public_path('material'));
    }

    protected function migrate()
    {
        $this->info("Migrating the database tables into your application");
        if (!Schema::hasTable('activity_log')) {
            $this->call('vendor:publish', ['--provider' => 'Spatie\Activitylog\ActivitylogServiceProvider', '--tag' => 'migrations']);
        }
        $timestamp = date('Y_m_d_His', time());
        static::copyFile('migrations/create_admin_users_roles_permissions_tables.php', $this->getModulePath() ."/Database/Migrations/{$timestamp}_create_admin_users_roles_permissions_tables.php");
        static::copyFile('migrations/create_pages_table.php', $this->getModulePath() ."/Database/Migrations/{$timestamp}_create_pages_table.php");
        static::copyFile('migrations/create_settings_table.php', $this->getModulePath() ."/Database/Migrations/{$timestamp}_create_settings_table.php");
        $this->call('migrate');
        $this->call('module:migrate', ['Admin']);

    }

    /**
     * Copy a directory
     *
     * @param string $directory
     * @param string $destination
     * @return void
     */
    private static function copyDirectory($directory, $destination)
    {
        (new Filesystem)->copyDirectory(static::PUBLISHSPATH.$directory, $destination);
    }

    /**
     * Copy a directory
     *
     * @param string $file
     * @param string $destination
     * @return void
     */
    private static function copyFile($file, $destination)
    {
        (new Filesystem)->copy(static::PUBLISHSPATH.$file, $destination);
    }
}
