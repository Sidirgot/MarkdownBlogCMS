<?php

namespace Tests\Feature\Backend\Backend;

use App\SocialMedia;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SocialMediaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_a_social_media_account()
    {
        $this->admin();

        $data = factory(SocialMedia::class)->raw();

        $response = $this->json('post', route('socialMedia.store'), $data)
                         ->assertStatus(201)
                         ->decodeResponseJson();

        $this->assertDatabaseHas('social_media', [
            'social_share_url' => $response['social_share_url'],
            'social_name' => $response['social_name'],
            'social_icon' => $response['social_icon']
        ]);
    }

    /** @test */
    public function update_social_media_account()
    {
        $this->admin();

        $socialMedia = factory(SocialMedia::class)->create();

        $data = ['social_name' => 'facebook'];

        $response = $this->json('patch', route('socialMedia.update', $socialMedia), $data)
                         ->assertStatus(200)
                         ->decodeResponseJson();

        $this->assertDatabaseMissing('social_media', ['social_name' => $socialMedia->social_name]);
        $this->assertDatabaseHas('social_media', ['social_name' => $response['social_name']]);
        $this->assertEquals($data['social_name'], $response['social_name']);

    }

    /** @test */
    public function fetch_all_the_social_media_accounts()
    {
        $this->admin();

        factory(SocialMedia::class, 7)->create();

        $response = $this->json('get', route('socialMedia.index'))
                         ->assertStatus(200)
                         ->decodeResponseJson();

        $this->assertEquals(SocialMedia::count(), count($response));
    }

    /** @test */
    public function fetch_a_specific_social_media_account()
    {
        $this->admin();

        $socialMedia = factory(SocialMedia::class)->create();

        $response = $this->json('get', route('socialMedia.show', $socialMedia))
                         ->assertStatus(200)
                         ->decodeResponseJson();

        $this->assertEquals($socialMedia->id, $response['id']);
        $this->assertEquals($socialMedia->social_name, $response['social_name']);

    }

    /** @test */
    public function delete_a_specific_social_media_account()
    {
        $this->admin();

        $socialMedia = factory(SocialMedia::class)->create();

        $this->json('delete', route('socialMedia.destroy', $socialMedia))
             ->assertStatus(200)
             ->decodeResponseJson();

        $this->assertDatabaseMissing('social_media', ['id' => $socialMedia->id ]);
    }
}
