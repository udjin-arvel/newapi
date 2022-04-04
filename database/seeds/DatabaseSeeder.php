<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
	    // $this->call(RoleTableSeeder::class);
	    // $this->call(PermissionTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(BooksTableSeeder::class);
        // $this->call(StoriesTableSeeder::class);
        // $this->call(FragmentsTableSeeder::class);
        // $this->call(TagsTableSeeder::class);
        // $this->call(NotionsTableSeeder::class);
        // $this->call(NotesTableSeeder::class);
        // $this->call(LoreItemsTableSeeder::class);
        // $this->call(SubscriptionsTableSeeder::class);
        // $this->call(DescriptionSeeder::class);
    }
}
