<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRolesAndPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-roles-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates initial permission and roles';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createRoles();
        $this->createPermissions();
        return Command::SUCCESS;
    }

    protected function createRoles()
    {
        $this->info("Creating roles");
        $roles = ['super admin', 'manager', 'doctor', 'patient'];
        foreach ($roles as $role) {
            if (is_null(Role::where(['name'=>$role])->first())){
                Role::create(['name' => $role]);
            }

        }

    }

    protected function createPermissions()
    {
        $this->info("Creating permissions");
        foreach ($this->getRoutes() as $route) {
            if ($route->getName() != '') {
                foreach ($route->getAction()['middleware'] as $middleware) {
                    if (!in_array($middleware, ['web','api'])){
                        continue;
                    }
                    $permission = Permission::where(['name' => $route->getName(), 'guard_name' => $middleware])->first();
                    if (is_null($permission)) {
                        $this->info("Creating [$middleware] {$route->getName()}");
                        Permission::create(['name' => $route->getName(), 'guard_name' => $middleware]);
                    }
                }

            }
        }

    }

    protected function getRoutes()
    {
        return Route::getRoutes()->getRoutes();
    }
}
