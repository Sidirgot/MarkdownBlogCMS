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
    public function a_guest_can_subscribe_to_our_newsletter()
    {
        $data = ['email' => 'awesome@app.com'];

        $this->json('post', route('new.subscriber'), $data);

        $this->assertDatabaseHas('subscribers', ['email' => $data['email']]);

        $this->assertNotNull(Subscriber::whereEmail($data['email'])->first()->token);
    }

    /** @test */
    public function abord_submission_if_valid_hidden_filed_is_not_empty()
    {
        $data = ['valid' => 'random data','email' => 'app@email.com'];

        $this->json('post', route('new.subscriber'), $data)
             ->assertStatus(404)
             ->assertHeader('Content-Type', 'application/json');
    }

    /** @test */
    public function a_newsletter_subscriber_can_unsubscribe()
    {
        $data = ['email' => 'awesome@app.com' ];

        $this->json('post', route('new.subscriber'), $data);

        $this->assertDatabaseHas('subscribers', ['email' => $data['email']]);

        $subscriber = Subscriber::whereEmail($data['email'])->first();

        $this->json('delete', route('subscribers.cancel', [$subscriber->email,$subscriber->token]));

        $this->assertDatabaseMissing('subscribers', ['email' => $subscriber->email]);
    }

}