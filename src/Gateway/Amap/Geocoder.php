<?php

namespace johnxu\map\Gateway\Amap;

use InvalidArgumentException;
use johnxu\map\Exception\InvalidConfigException;
use johnxu\map\Exception\InvalidGatewayException;
use johnxu\map\GatewayInterface\GeocoderInterface;
use johnxu\tool\Config;
use johnxu\tool\Http;

class Geocoder implements GeocoderInterface
{

    private $geoUrl   = 'https://restapi.amap.com/v3/geocode/geo';
    private $reGeoUrl = 'https://restapi.amap.com/v3/geocode/regeo';
    private $output   = 'json';


    /**
     * 地理编码
     * @param array $params
     * @return mixed
     * @throws InvalidConfigException
     * @link https://lbs.amap.com/api/webservice/guide/api/georegeo
     */
    public function geo(array $params)
    {
        if (!$ak = Config::getInstance()->get('amap_key')) {
            throw new InvalidConfigException("Lack of configuration file parameters: [amap_key]");
        } elseif (!isset($params['address']) || empty($params['address'])) {
            throw new InvalidArgumentException("Lack of required parameters: [address]");
        }
        $params = array_merge(['key' => $ak, 'output' => $this->output], $params);

        return $this->request($this->geoUrl, $params);
    }

    /**
     * 逆向地理编码
     * @param array $params
     * @return mixed
     * @throws InvalidConfigException
     * @throws InvalidGatewayException
     * @link https://lbs.amap.com/api/webservice/guide/api/georegeo
     */
    public function reGeo(array $params)
    {
        if (!$ak = Config::getInstance()->get('amap_key')) {
            throw new InvalidConfigException("Lack of configuration file parameters: [amap_key]");
        } elseif (!isset($params['location']) || empty($params['location'])) {
            throw new InvalidArgumentException("Lack of required parameters: [location]");
        }
        $params = array_merge(['key' => $ak, 'output' => $this->output], $params);

        return $this->request($this->reGeoUrl, $params);
    }

    private function request(string $uri, array $params)
    {
        $response = Http::getInstance()->request($uri, $params)->getContent();
        if ($response['status'] != 1) {
            throw new InvalidGatewayException($response['message'] ?? $response['msg'] ?? $response['info']);
        }

        return $response;
    }
}