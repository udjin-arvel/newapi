<?php

namespace Tests\Feature;

use Tests\Fixtures\StoryFixture;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiStoryTest extends TestCase
{
    use WithoutMiddleware;

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
     * @test
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
}
