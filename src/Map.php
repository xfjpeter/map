<?php

namespace johnxu\map;

use johnxu\map\Exception\InvalidConfigException;
use johnxu\map\GatewayInterface\GeocoderInterface;
use johnxu\tool\Config;
use johnxu\tool\traits\Singleton;
use johnxu\map\Exception\InvalidGatewayException;

/**
 * Class Map
 * @method GeocoderInterface geocoder($driver)
 * @package johnxu\map
 */
class Map
{
    use Singleton;

    public function __construct(array $config)
    {
        Config::getInstance()->batch($config);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws InvalidGatewayException
     * @throws InvalidArgumentException
     * @throws InvalidConfigException
     */
    public function __call($name, $arguments)
    {
        return $this->makeDriver($name, ...$arguments);
    }

    /**
     * @param $class
     * @param $driver
     * @return mixed
     * @throws InvalidGatewayException
     * @throws InvalidArgumentException
     * @throws InvalidConfigException
     */
    protected function makeDriver($class, $driver)
    {
        $classes = 'johnxu\\map\\Gateway\\'.ucfirst($driver).'\\'.ucfirst($class);

        if (!class_exists($classes)) {
            throw new InvalidGatewayException("Gateway driver [$classes] not found.");
        }

        return new $classes;
    }
}
