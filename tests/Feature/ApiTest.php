<?php

namespace Tests\Feature;

use Tests\Fixtures\CompositionFixture;
use Tests\Fixtures\StoryFixture;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use WithoutMiddleware;
    
    /**
     */
    public function getCommentsTest()
    {
        $response = $this
            ->withoutExceptionHandling()
            ->actingAs(User::findOrFail(1))
            ->getJson('/api/comment/all?content_type=story&content_id=1')
        ;
        
        $response->assertStatus(200);
    }
    
    /**
     */
    public function getNotesTest()
    {
        $response = $this
            ->withoutExceptionHandling()
            ->actingAs(User::findOrFail(1))
            ->getJson('/api/note/all')
        ;
        
        $response->assertStatus(200);
    }
    
    /**
     */
    public function getNotionTest()
    {
        $response = $this
            ->withoutExceptionHandling()
            ->actingAs(User::findOrFail(1))
            ->getJson('/api/notion/get/1')
        ;
        
        $response->assertStatus(200);
    }
    
    /**
     */
    public function getNotionsTest()
    {
        $response = $this
            ->withoutExceptionHandling()
            ->actingAs(User::findOrFail(1))
            ->getJson('/api/notion/all')
        ;
        
        $response->assertStatus(200);
    }
    
    /**
     */
    public function saveNotionTest()
    {
        $response = $this
            ->withoutExceptionHandling()
            ->actingAs(User::findOrFail(1))
            ->postJson('/api/notion/save', StoryFixture::storyFeature2)
        ;
        
        $response->assertStatus(200);
    }

    /**
     */
    public function getStoryTest()
    {
        $response = $this
            ->withoutExceptionHandling()
            ->actingAs(User::findOrFail(1))
            ->getJson('/api/story/get/1')
        ;

        $response->assertStatus(200);
    }

    /**
     */
    public function getStoriesTest()
    {
        $response = $this
            ->withoutExceptionHandling()
            ->actingAs(User::findOrFail(1))
            ->getJson('/api/story/all')
        ;

        $response->assertStatus(200);
    }

    /**
     */
    public function saveStoryTest()
    {
        $response = $this
            ->withoutExceptionHandling()
            ->actingAs(User::findOrFail(1))
            ->postJson('/api/story/save', StoryFixture::storyFeature2)
        ;

        $response->assertStatus(200);
    }
	
	/**
	 * @test
	 */
	public function saveCompositionTest()
	{
		$response = $this
			->withoutExceptionHandling()
			->actingAs(User::findOrFail(1))
			->postJson('/api/composition/save', CompositionFixture::feature1)
		;
		
		$response->assertStatus(200);
	}
}
