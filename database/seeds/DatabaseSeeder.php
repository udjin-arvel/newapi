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
        $this->call(UsersTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(SeriesTableSeeder::class);
        $this->call(StoriesTableSeeder::class);
        $this->call(FragmentsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(NotionsTableSeeder::class);
        $this->call(NotesTableSeeder::class);
        $this->call(LoreItemsTableSeeder::class);
    }
}
