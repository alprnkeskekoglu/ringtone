<?php

namespace Tests\Unit\Web;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use Dawnstar\Models\Ringtone;
use Tests\TestCase;

class SearchTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test()
    {
        $controller = new SearchController();


        //Index function
        $index = $controller->index();
        $this->assertEquals($index->getName(), 'web.search');
        $this->assertArrayHasKey('ringtones', $index->getData());
        $this->assertEquals(Ringtone::class, get_class($index->getData()['ringtones']->first()));


    }
}
