<?php
    
use App\Models\Story;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        factory(\App\Models\Tag::class, 20)->create();
        Story::all()->map(function ($story) {
            /**
             * @var Story $story
             */
            $story->tags()->attach(random_int(1, 20));
        });
    }
}
