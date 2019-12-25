<?php

namespace Tests\Unit\Web;

use App\Http\Controllers\CreditController;
use Dawnstar\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreditTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test()
    {
        $controller = new CreditController();
        $request = new \Illuminate\Http\Request();
        $request->headers->set('content-type', 'application/json');


        //Index function
        $index = $controller->index();
        $this->assertEquals($index->getName(), 'web.credit');



        //Credit function
        $user = User::find(1);
        $this->be($user);
        $request->initialize(['credit' => 15]);
        $credit = $controller->credit($request);
        $this->assertEquals(200, $credit->getStatusCode());
        $this->assertTrue($credit->isSuccessful());
    }
}
