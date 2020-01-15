<?php

namespace Tests\Feature\Backend;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function fetch_categories()
    {
        $this->admin();

        factory(Category::class, 2)->create();

        $this->json('GET', route('categories.index'))
             ->assertStatus(200)
             ->assertJsonCount(2);
    }

    /** @test */
    public function a_category_can_be_created()
    {
        $this->admin();

        $data = factory(Category::class)->raw();

        $response = $this->json('post', route('categories.store'), $data)
                         ->assertStatus(201)
                         ->decodeResponseJson();

        $this->assertDatabaseHas('categories', ['name' => $data['name']]);
        $this->assertEquals($data['name'], $response['name']);
    }

    /** @test */
    public function a_category_can_be_updated()
    {
        $this->admin();

        $category = factory(Category::class)->create();

        $data = factory(Category::class)->raw();

        $response = $this->json('patch', route('categories.update', $category), $data)
                         ->assertStatus(200)
                         ->decodeResponseJson();

        $this->assertDatabaseHas('categories', ['name' => $data['name']]);
        $this->assertDatabaseMissing('categories', ['name' => $category['name']]);
        $this->assertEquals($data['name'], $response['name']);

    }

    /** @test */
    public function a_category_can_be_deleted()
    {
        $this->admin();

        $category = factory(Category::class)->create();

        $response = $this->json('DELETE', route('categories.destroy', $category))->decodeResponseJson();

        $this->assertDatabaseMissing('categories', ['name' => $category['name']]);
        $this->assertEquals('deleted', $response);
    }

    /** @test */
    public function fetch_category()
    {
        $this->admin();

        factory(Category::class)->create();

        $category = Category::first();

        $response = $this->json('GET', route('categories.show', $category))
                    ->assertStatus(200)
                    ->decodeResponseJson();

        $this->assertEquals($response['name'], $category['name']);
    }
}
