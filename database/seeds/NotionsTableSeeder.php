<?php

use Illuminate\Database\Seeder;

class NotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        factory(\App\Models\Notion::class, 25)->create();
    }
}
