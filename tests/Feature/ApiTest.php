<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Fixtures\CompositionFixture;
use Tests\Fixtures\NotionFixture;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\Fixtures\StoryFixture;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use WithFaker, WithoutMiddleware;
    
	/**
	 * @var User
	 */
    protected $admin;
	
	/**
	 * Setup the test environment.
	 */
    protected function setUp(): void
    {
	    parent::setUp();
	
	    $this->setUpFaker();
	    $this->setUpUser();
    }
	
	/**
	 * Установить юзера
	 * Передать status, если нужен пользователь других полномочий
	 *
	 * @param string $status
	 * @return ApiTest
	 */
    protected function setUpUser(string $status = User::STATUS_ADMIN): self
    {
	    $this->admin = User::where('status', $status)->first();
	    return $this;
    }
    
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
     *
     */
    public function getCommentsTest()
    {
        $response = $this
            ->actingAs($this->admin)
            ->getJson('/api/comments?content_type=story&content_id=1')
        ;
        
        $this->getResultFromResponse($response);
        $response->assertStatus(200);
    }
    
    /**
     *
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
     *
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
	 *
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
     * 
     */
    public function getNotionsTest()
    {
        $response = $this
            ->actingAs($this->admin)
            ->getJson('/api/notions')
        ;
	
	    $this->getResultFromResponse($response);
        $response->assertStatus(200);
    }
	
	/**
	 *
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
	 *
	 */
	public function getTagsTest()
	{
		$response = $this
			->actingAs($this->admin)
			->getJson('/api/tags?used=1')
		;
		
		$this->getResultFromResponse($response);
		$response->assertStatus(200);
    }
	
	/**
	 * @test
	 */
	public function getCompositionTest()
	{
		$response = $this
			->actingAs($this->admin)
			->getJson('/api/compositions/1')
		;
		
		$this->getResultFromResponse($response);
		$response->assertStatus(200);
	}
    
    /**
     *
     */
    public function getStoryTest()
    {
        $response = $this
            ->actingAs($this->admin)
            ->getJson('/api/stories/1')
        ;
	
	    $this->getResultFromResponse($response);
        $response->assertStatus(200);
    }

    /**
     *
     */
    public function getStoriesTest()
    {
        $response = $this
            ->actingAs($this->admin)
            ->getJson('/api/stories')
        ;
	
	    $this->getResultFromResponse($response);
        $response->assertStatus(200);
    }
	
	/**
	 *
	 */
    public function saveStoryTest()
    {
        $response = $this
            ->actingAs($this->admin)
            ->postJson('/api/stories', StoryFixture::getFixture($this->faker))
        ;
	
	    $this->getResultFromResponse($response);
        $response->assertStatus(201);
    }
	
	/**
	 *
	 */
	public function updateStoryTest()
	{
		$response = $this
			->actingAs($this->admin)
			->putJson('/api/stories/1', StoryFixture::getFixture($this->faker, ['tags', 'fragments', 'descriptions']))
		;
		
		$this->getResultFromResponse($response);
		$response->assertStatus(201);
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
	
	/**
	 *
	 */
	public function likeContentTest()
	{
		$response = $this
			->actingAs($this->admin)
			->getJson('/api/like?content_id=2&content_type=story&type=like')
		;
		
		$this->getResultFromResponse($response);
		$response->assertStatus(200);
	}

	/**
	 *
	 */
	public function getConfigsTest()
	{
		$response = $this
			->actingAs($this->admin)
			->getJson('/api/presets')
		;
		
		$this->getResultFromResponse($response);
		$response->assertStatus(200);
	}
	
	/**
	 *
	 */
	public function getSubscriptionsTest()
	{
		$response = $this
			->actingAs($this->admin)
			->getJson('/api/subscriptions')
		;
		
		$this->getResultFromResponse($response);
		$response->assertStatus(200);
	}
	
	/**
	 *
	 */
	public function getGalleryTest()
	{
		$response = $this
			->actingAs($this->admin)
			->getJson('/api/loreitems?content_id=1&content_type=Loreitem')
		;
		
		$this->getResultFromResponse($response);
		$response->assertStatus(200);
	}
}
