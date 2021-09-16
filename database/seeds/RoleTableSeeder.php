<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Role::create(['name' => 'Administrator', 'slug' => 'administrator']);
	    Role::create(['name' => 'Moderator', 'slug' => 'moderator']);
	    Role::create(['name' => 'Corrector', 'slug' => 'corrector']);
	    Role::create(['name' => 'Writer', 'slug' => 'writer']);
	    Role::create(['name' => 'Reader', 'slug' => 'reader']);
    }
}
