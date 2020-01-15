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
}
