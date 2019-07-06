<?php

namespace johnxu\map\Gateway\Baidu;

use InvalidArgumentException;
use johnxu\map\Exception\InvalidConfigException;
use johnxu\map\Exception\InvalidGatewayException;
use johnxu\map\GatewayInterface\GeocoderInterface;
use johnxu\tool\Config;
use johnxu\tool\Http;

class Geocoder implements GeocoderInterface
{

    private $geoUrl   = 'http://api.map.baidu.com/geocoding/v3/';
    private $reGeoUrl = 'http://api.map.baidu.com/reverse_geocoding/v3';
    private $output   = 'json';


    /**
     * 地理编码
     * @param array $params
     * @return mixed
     * @throws InvalidConfigException
     * @link http://lbsyun.baidu.com/index.php?title=webapi/guide/webservice-geocoding
     */
    public function geo(array $params)
    {
        if (!$ak = Config::getInstance()->get('baidu_key')) {
            throw new InvalidConfigException("Lack of configuration file parameters: [baidu_key]");
        } elseif (!isset($params['address']) || empty($params['address'])) {
            throw new InvalidArgumentException("Lack of required parameters: [address]");
        }
        $params = array_merge(['ak' => $ak, 'output' => $this->output], $params);

        return $this->request($this->geoUrl, $params);
    }

    /**
     * 逆向地理编码
     * @param array $params
     * @return mixed
     * @throws InvalidConfigException
     * @throws InvalidGatewayException
     * @link http://lbsyun.baidu.com/index.php?title=webapi/guide/webservice-geocoding-abroad
     */
    public function reGeo(array $params)
    {
        if (!$ak = Config::getInstance()->get('baidu_key')) {
            throw new InvalidConfigException("Lack of configuration file parameters: [baidu_key]");
        } elseif (!isset($params['location']) || empty($params['location'])) {
            throw new InvalidArgumentException("Lack of required parameters: [location]");
        }
        $params = array_merge(['ak' => $ak, 'output' => $this->output], $params);

        return $this->request($this->reGeoUrl, $params);
    }

    private function request(string $uri, array $params)
    {
        $response = Http::getInstance()->request($uri, $params)->getContent();
        if ($response['status'] !== 0) {
            throw new InvalidGatewayException($response['message'] ?? $response['msg']);
        }

        return $response;
    }
}