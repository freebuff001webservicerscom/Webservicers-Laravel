<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DebugHomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_debug(): void
    {
        \Illuminate\Support\Facades\DB::enableQueryLog();
        $response = $this->get('/');
        $queries = \Illuminate\Support\Facades\DB::getQueryLog();
        $response->dump();
        $this->assertEquals(200, $response->getStatusCode());
    }
}
