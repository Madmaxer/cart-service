<?php

namespace App\Product\Connector;

use App\Exceptions\ClassNotFoundException;
use App\Exceptions\ConfigurationException;
use GuzzleHttp\Client;

class ConnectorFactory
{
    /**
     * @param array  $config
     * @param Client $client
     *
     * @return ConnectorContract
     */
    public static function create(array $config, Client $client): ConnectorContract
    {
        $connectorClassName = $config['connector'];

        if (!class_exists($connectorClassName)) {
            throw new ClassNotFoundException(sprintf('Connector class not found: %s', $connectorClassName));
        }

        $connector = new $connectorClassName($config, $client);

        if (!$connector instanceof ConnectorContract) {
            throw new ConfigurationException('Specified connector class invalid');
        }

        return $connector;
    }
}
