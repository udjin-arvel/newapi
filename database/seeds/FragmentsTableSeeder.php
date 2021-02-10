<?php

use Illuminate\Database\Seeder;

class FragmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Fragment::class, 100)->create();
    }
}
