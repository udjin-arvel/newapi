<?php

    use Faker\Generator as Faker;
    use Illuminate\Database\Seeder;

class StoriesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 * @throws Exception
	 */
    public function run(Faker $faker)
    {
        factory(\App\Models\Story::class, 20)->create();
    }
}
