<?php

namespace Tests\Unit\Web;

use App\Http\Controllers\RingtoneController;
use Tests\TestCase;

class RingtoneTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test()
    {
        $controller = new RingtoneController();
        $request = new \Illuminate\Http\Request();
        $request->headers->set('content-type', 'application/json');


        //Index function
        $index = $controller->index();
        $this->assertEquals($index->getName(), 'web.ringtone.index');
        $this->assertArrayHasKey('categories', $index->getData());
        $this->assertArrayHasKey('ringtones', $index->getData());


        //Filter function
        $filter = $controller->filter($request);
        $this->assertIsString($filter);



        //Download function
        $request->initialize(['ringtone_id' => 2]);
        $download = $controller->download($request);
        $this->assertEquals(200, $download->getStatusCode());
        $this->assertTrue($download->isSuccessful());
    }
}
