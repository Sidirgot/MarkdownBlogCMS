<?php

namespace Tests\Feature\Frontend;

use App\Subscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriberControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function a_guest_can_subscribe_to_the_newsletter()
    {
        $data = ['email' => 'awesome@app.com'];

        $this->json('post', route('new.subscriber'), $data);

        $this->assertDatabaseHas('subscribers', ['email' => $data['email']]);

        $this->assertNotNull(Subscriber::whereEmail($data['email'])->first()->token);
    }

    /** @test */
    public function a_newsletter_subscriber_can_unsubscribe()
    {
        $subscriber = factory(Subscriber::class)->create();

        $this->json('delete', route('subscribers.cancel', [$subscriber->email,$subscriber->token]));

        $this->assertDatabaseMissing('subscribers', ['email' => $subscriber->email]);
    }

    /** @test */
    public function abord_if_request_has_valid_hidden_field()
    {
        $this->withExceptionHandling();

        $data = ['email' => 'new@mail.com', 'valid' => 'notempty'];

        $this->json('post', route('new.subscriber'), $data)->assertStatus(403);

    }

}