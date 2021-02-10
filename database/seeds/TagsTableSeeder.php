<?php

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
        
        $tagStory = [];
        for ($i = 1; $i <= 50; $i++) {
            $tagStory[] = [
              'story_id' => random_int(1, 20),
              'tag_id' => random_int(1, 20),
            ];
        }
    
        \DB::table('story_tag')->insert($tagStory);
    }
}
