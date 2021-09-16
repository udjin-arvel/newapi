<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Permission::create(['name' => 'Can everything', 'slug' => 'can-everything']);
	    Permission::create(['name' => 'Redact content', 'slug' => 'redact-content']);
	    Permission::create(['name' => 'Delete content', 'slug' => 'delete-content']);
	    Permission::create(['name' => 'Make correction', 'slug' => 'redact-content']);
	    Permission::create(['name' => 'Can read', 'slug' => 'can-read']);
    }
}
