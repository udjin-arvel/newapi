<?php

namespace Tests\Feature;

use Tests\Fixtures\CompositionFixture;
use Tests\Fixtures\NotionFixture;
use Tests\Fixtures\StoryFixture;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use WithoutMiddleware;
	
	/**
	 * @param $response
	 * @return mixed
	 */
    public function getResultFromResponse($response)
    {
    	$data = json_decode($response->getContent(), true);
    	return $data;
    }
    
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
     * @test
     */
    public function getNotionTest()
    {
        $response = $this
            ->withoutExceptionHandling()
            ->actingAs(User::findOrFail(1))
            ->getJson('/api/notions/1')
        ;
	
        $response->assertStatus(200);
    }
	
	/**
	 */
	public function deleteNotionTest()
	{
		$response = $this
			->withoutExceptionHandling()
			->actingAs(User::findOrFail(1))
			->deleteJson('/api/notions/8')
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
            ->getJson('/api/notions')
        ;
	
        $response->assertStatus(200);
    }
	
	/**
	 */
	public function storeNotionTest()
	{
		$response = $this
			->withoutExceptionHandling()
			->actingAs(User::findOrFail(1))
			->postJson('/api/notions', NotionFixture::notionFeature1)
		;
		
		$response->assertStatus(201);
	}
    
    /**
     *
     */
    public function updateNotionTest()
    {
        $response = $this
            ->withoutExceptionHandling()
            ->actingAs(User::findOrFail(1))
            ->putJson('/api/notions/1', NotionFixture::notionFeature2)
        ;
        
        $response->assertStatus(201);
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
