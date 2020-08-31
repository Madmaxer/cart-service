<?php

namespace App\Test\Feature\v1;

use App\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCart(): void
    {
        $response = $this->post('/api/v1/cart');
        $response->assertStatus(201);
        $this->assertSame(
            $response->getContent(),
            \json_encode(['data' => ['cart_id' => 1, 'total_price' => 0, 'details' => []]])
        );
    }

    public function testReadCart(): void
    {
        $this->post('/api/v1/cart');

        $response = $this->get('/api/v1/cart/1');
        $response->assertStatus(200);
        $this->assertSame(
            $response->getContent(),
            \json_encode(['data' => ['cart_id' => 1, 'total_price' => 0, 'details' => []]])
        );
    }

    public function testAddProductToCart(): void
    {
        $this->post('/api/v1/cart');

        $response = $this->patch('/api/v1/cart/1', ['product_id' => 1, 'amount' => 1]);
        $response->assertStatus(200);
    }
}
