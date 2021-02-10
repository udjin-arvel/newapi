<?php

use Illuminate\Database\Seeder;

class LoreItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\LoreItem::class, 4)->create();
    }
}
