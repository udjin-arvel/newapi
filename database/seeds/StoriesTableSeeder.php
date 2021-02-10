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
    
        $commentStory = [];
        for ($i = 1; $i <= 50; $i++) {
            $commentStory[] = [
                'story_id' => random_int(1, 20),
                'text' => $faker->realText(200),
                'importance' => random_int(1, 10),
            ];
        }
    
        \DB::table('story_comments')->insert($commentStory);
    }
}
