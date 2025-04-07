<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up(): void
    {
        Permission::create(['name' => 'all-access']);

        Role::create(['name' => 'admin'])->givePermissionTo('all-access');
        Role::create(['name' => 'paciente']);
        Role::create(['name' => 'profissional']);
        Role::create(['name' => 'clinica']);
    }
};
