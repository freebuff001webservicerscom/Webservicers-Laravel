<?php
namespace Tests\Feature;

use Tests\TestCase;

class DebugHomeTest2 extends TestCase
{
    public function test_home_debug2(): void
    {
        $response = $this->get('/');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
