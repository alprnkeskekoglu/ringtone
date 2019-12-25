<?php

namespace Tests\Unit\Web;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RingtoneController;
use Dawnstar\Models\User;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test()
    {
        $controller = new ProfileController();
        $request = new \Illuminate\Http\Request();
        $request->headers->set('content-type', 'application/json');

        $user = User::find(1);
        $this->be($user);

        //Index function
        $index = $controller->index();
        $this->assertEquals($index->getName(), 'web.profile.index');
        $this->assertArrayHasKey('categories', $index->getData());
        $this->assertArrayHasKey('ringtones', $index->getData());


        //Filter function
        $filter = $controller->filter($request);
        $this->assertIsString($filter);
    }
}
