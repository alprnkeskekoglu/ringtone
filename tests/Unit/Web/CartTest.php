<?php

namespace Tests\Unit\Web;

use App\Http\Controllers\CartController;
use Dawnstar\Models\Ringtone;
use Dawnstar\Models\User;
use Tests\TestCase;

class CartTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test()
    {
        $controller = new CartController();
        $request = new \Illuminate\Http\Request();
        $request->headers->set('content-type', 'application/json');

        $user = User::find(1);
        $this->be($user);
        $request->initialize(['ringtone_id' => 2]);

        //Index function
        $index = $controller->index($request);
        $session = session()->get('1_cart');
        $session = json_decode(decrypt($session), 1);
        $this->assertTrue(in_array(2, $session));
        $this->assertEquals(200, $index->getStatusCode());
        $this->assertTrue($index->isSuccessful());
        $this->assertIsString($index->getData()->view);
    }
}
