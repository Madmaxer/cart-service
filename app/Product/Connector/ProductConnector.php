<?php

namespace App\Product\Connector;

use App\Exceptions\ConfigurationException;
use App\Product\Exceptions\LoadProductFailed;
use App\Product\Product;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;

class ProductConnector implements ConnectorContract
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $baseUri;

    /**
     * @param array  $config
     * @param Client $client
     */
    public function __construct(array $config, Client $client)
    {
        $baseUri = Arr::get($config, 'base_uri');

        if (!$baseUri) {
            throw new ConfigurationException('Missing base uri');
        }

        $this->baseUri = $baseUri;
        $this->client = $client;
    }

    /**
     * @inheritdoc
     */
    public function loadProduct(int $productId): Product
    {
        $response = $this->client->get(
            "{$this->baseUri}/api/v1/product/{$productId}",
            [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]
        );

        if ($response->getStatusCode() === Response::HTTP_NOT_FOUND) {
            throw new LoadProductFailed('Product not found');
        }

        if ($response->getStatusCode() === Response::HTTP_OK) {
            return $this->loadProductDataFromResponse($response);
        }

        throw new \RuntimeException("Unexpected response received, status: {$response->getStatusCode()}");
    }

    /**
     * @param ResponseInterface $response
     *
     * @return Product
     */
    private function loadProductDataFromResponse(ResponseInterface $response): Product
    {
        $responseBody = json_decode((string) $response->getBody(), true);

        $productId = Arr::get($responseBody, 'data.id');
        $productName = Arr::get($responseBody, 'data.name');
        $productPrice = Arr::get($responseBody, 'data.price');
        $productCurrency = Arr::get($responseBody, 'data.currency');

        return new Product($productId, $productName, $productPrice, $productCurrency);
    }
}
