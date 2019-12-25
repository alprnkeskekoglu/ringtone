<?php

namespace Tests\Unit\Web;

use App\Http\Controllers\PurchaseController;
use Dawnstar\Models\User;
use Tests\TestCase;

class PurchaseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test()
    {
        $controller = new PurchaseController();

        $user = User::find(1);
        $this->be($user);

        //Index function
        $index = $controller->index();
        $this->assertEquals($index->getName(), 'web.purchase');
        $this->assertArrayHasKey('ringtones', $index->getData());


        //Purchase function
        $index = $controller->purchase();

        $session = session()->get('1_cart');
        $this->assertEquals(null, $session);
        $this->assertTrue($index->isSuccessful());
        $this->assertEquals(200, $index->getStatusCode());
    }
}
