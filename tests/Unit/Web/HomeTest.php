<?php

namespace Tests\Unit\Web;

use App\Http\Controllers\HomeController;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test()
    {
        $controller = new HomeController();


        //Index function
        $index = $controller->index();
        $this->assertEquals($index->getName(), 'web.home');
        $this->assertArrayHasKey('newest', $index->getData());
        $this->assertArrayHasKey('popularities', $index->getData());
        $this->assertArrayHasKey('prices', $index->getData());


    }
}
