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
    
        $notionStory = [];
        for ($i = 1; $i <= 50; $i++) {
            $notionStory[] = [
                'story_id' => random_int(1, 20),
                'notion_id' => random_int(1, 25),
            ];
        }
    
        \DB::table('story_notion')->insert($notionStory);
    }
}
