<?php
    
use App\Models\User;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
	/**
	 * Теги по умолчанию
	 */
	const BASE_TAGS = [
		'Икари',
		'Рен',
		'Ано',
		'Первый Ано',
		'Ева',
		'Бан',
		'Бонибел',
		'Первые миры',
		'Джон',
		'Ио',
		'Алиса',
		'Творец',
		'Странные зоны',
		'Сущностный план',
		'Смертный план',
		'Божественный план',
		'Хелеон',
		'Хавенон',
		'Этарион',
		'Великие весы',
	];
	
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
    	$admin = User::where('status', User::STATUS_ADMIN)->first();
    	$now = now();
    	
    	if ($admin) {
    		$tags = collect(self::BASE_TAGS)->map(function ($tag) use ($admin, $now) {
			    return [
				    'name'       => $tag,
				    'stem'       => $tag,
				    'user_id'    => $admin->id,
				    'created_at' => $now,
				    'updated_at' => $now,
			    ];
		    });
    		
    		DB::table('tags')->insert($tags->toArray());
	    }
    
//        factory(\App\Models\Tag::class, 20)->create();
//        Story::all()->map(function ($story) {
//            /**
//             * @var Story $story
//             */
//            $story->tags()->attach(random_int(1, 20));
//        });
    }
}
