<?php

namespace App\Product;

use App\Exceptions\ConfigurationException;
use App\Product\Connector\ConnectorFactory;
use GuzzleHttp\Client;

/**
 * Class ProductServiceFactory
 * @package App\Token
 */
class ProductServiceFactory
{
    /**
     * Create a user service.
     *
     * @param array  $config
     * @param Client $client
     *
     * @return ProductService
     *
     * @throws ConfigurationException
     */
    public static function create(array $config, Client $client): ProductService
    {
        if (!array_key_exists('connector', $config)) {
            throw new ConfigurationException('Connector method not specified.');
        }

        return new ProductService(ConnectorFactory::create($config, $client));
    }
}
