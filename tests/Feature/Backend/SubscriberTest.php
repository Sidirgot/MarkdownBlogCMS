<?php

namespace Tests\Feature\Backend;

use App\Subscriber;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriberTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function get_all_the_subscribers()
    {
        $this->admin();

        $subs = factory(Subscriber::class, 10)->create();

        $res = $this->json('get', route('subscribers.index'))->decodeResponseJson();

        $this->assertEquals($res['total'], count($subs));
    }

    /** @test */
    public function delete_a_subscriber()
    {
        $this->admin();

        $sub = factory(Subscriber::class)->create();

        $this->json('delete', route('subscribers.destroy', $sub->id));
        
        $this->assertDatabaseMissing('subscribers', ['email' => $sub->email]);
    }
}
