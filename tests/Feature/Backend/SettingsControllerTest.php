<?php

namespace Tests\Feature\Backend;

use App\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SettingsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function user_can_add_a_new_setting()
    {
        $this->admin();

        $data = ['type' => 'about', 'value' => 'This is an about paragraph detailing what my website is all about. Describe what you are all about!'];

        $response = $this->json('post', route('settings.store'), $data)->assertStatus(201)->decodeResponseJson();

        $this->assertDatabaseHas('settings', ['type' => $data['type']]);
        $this->assertDatabaseHas('settings', ['value' => $data['value']]);
        $this->assertEquals($response['type'], $data['type']);
        $this->assertEquals($response['value'], $data['value']);
    }

    /** @test */
    public function user_can_updated_a_setting()
    {
        $this->admin();

        $setting = factory(Setting::class)->create();

        $data = ['type' => 'something else'];

        $response = $this->json('patch', route('settings.update', $setting->id), $data)->assertStatus(200)->decodeResponseJson();

        $this->assertDatabaseMissing('settings', ['type' => $setting->type]);
        $this->assertDatabaseHas('settings', ['type' => $data['type']]);
        $this->assertEquals($response['type'], $data['type']);
    }

    /** @test */
    public function user_can_see_a_setting()
    {
        $this->admin();

        $setting = factory(Setting::class)->create();

        $response = $this->json('get', route('settings.show', $setting->id))->assertStatus(200)
                         ->decodeResponseJson();

        $this->assertEquals($response['type'], $setting->type);
    }

    /** @test */
    public function user_can_delete_a_setting()
    {
        $this->admin();

        $setting = factory(Setting::class)->create();

        $this->json('delete', route('settings.destroy', $setting->id))->assertStatus(200);

        $this->assertDatabaseMissing('settings', ['type' => $setting->type]);
    }
}