<?php
/**
 * | ---------------------------------------------------------------------------------------------------
 * | ProjectName: map
 * | ---------------------------------------------------------------------------------------------------
 * | Author：johnxu <fsyzxz@163.com>
 * | ---------------------------------------------------------------------------------------------------
 * | Home: https://www.xfjpeter.cn
 * | ---------------------------------------------------------------------------------------------------
 * | Data: 201907062019-07-06
 * | ---------------------------------------------------------------------------------------------------
 * | Desc:
 * | ---------------------------------------------------------------------------------------------------
 */

require('../../../vendor/autoload.php');

use johnxu\map\Exception\InvalidConfigException as InvalidConfigExceptionAlias;
use johnxu\map\Exception\InvalidGatewayException as InvalidGatewayExceptionAlias;
use johnxu\map\Map;

$config = [
    'amap_key'  => '',
    'baidu_key' => 'f2P4pO8SvOV0ek4O3IkW1GrvF3WHQaDa',
    'qq_key'    => 'P3ABZ-LVTHU-VKRVG-4ZOUS-5FB55-C2F64',
];
$params = [
    'location' => '39.98296,'.'116.30676',
];
try {
    $result = Map::getInstance($config)->geocoder('qq')->reGeo($params);

    print_r($result);

    // $result['result']['formatted_addresses']['recommend']; // 具体地址
    // $result['result']['address_component']['nation']; // 国家
    // $result['result']['address_component']['province']; // 省
    // $result['result']['address_component']['city']; // 市
    // $result['result']['address_component']['district']; // 区
    // $result['result']['address_component']['street']; // 街道
    // $result['result']['address_component']['street_number']; // 街道号

} catch (InvalidConfigExceptionAlias $e) {
    echo "配置文件错误：".$e->getMessage();
} catch (InvalidArgumentException $e) {
    echo "参数错误：".$e->getMessage();
} catch (InvalidGatewayExceptionAlias $e) {
    echo "网关或接口返回错误：".$e->getMessage();
}