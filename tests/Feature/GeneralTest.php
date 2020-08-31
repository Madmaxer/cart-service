<?php

namespace App\Test\Feature;

use App\Test\TestCase;

class GeneralTest extends TestCase
{
    public function testHealth(): void
    {
        $response = $this->get('/health');
        $response->assertStatus(200);
    }

    public function testHeartbeat(): void
    {
        $response = $this->get('/heartbeat');
        $response->assertStatus(200);
    }

    public function testVersion(): void
    {
        $response = $this->get('/version');
        $response->assertStatus(200);
    }
}
