<?php

namespace Tests\Feature\Backend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MarkdownImagesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function upload_image_from_the_markdown()
    {
        $this->admin();

        Storage::fake('public_uploads');

        $image = [ 'image' => UploadedFile::fake()->image('markdown.jpg')];

        $response = $this->json('post', route('markdown.upload'), $image)
                         ->assertStatus(201)
                         ->decodeResponseJson();

        Storage::disk('public_uploads')->assertExists('uploads/', $image['image']->getClientOriginalname());
        $this->assertEquals('uploaded', $response);
    }

    /** @test */
    public function get_all_the_uploaded_images()
    {
        $this->admin();

        Storage::fake('public_uploads');

        $image = [ 'image' => UploadedFile::fake()->image('markdown.jpg')];

        $this->json('post', route('markdown.upload'), $image)->decodeResponseJson();

        Storage::disk('public_uploads')->assertExists('uploads/', $image['image']->getClientOriginalname());

        $res = $this->json('get', route('markdown.images'))->decodeResponseJson();

        $this->assertCount(1, $res);
    }

     /** @test */
     public function delete_uploaded_image_from_the_disk()
     {
        $this->admin();

        Storage::fake('public_uploads');

        $image = [ 'image' => UploadedFile::fake()->image('markdown.jpg')];

        $this->json('post', route('markdown.upload'), $image)->decodeResponseJson();

        Storage::disk('public_uploads')->assertExists('uploads/', $image['image']->getClientOriginalname());

        $res = $this->json('get', route('markdown.images'))->decodeResponseJson();

        $this->json('post', route('markdown.destroy'), $res[0]);

        Storage::disk('public_uploads')->assertMissing('uploads/'. $image['image']->getClientOriginalname());
     }
}
