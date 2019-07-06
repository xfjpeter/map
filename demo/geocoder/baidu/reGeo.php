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
    'qq_key'    => '',
];
$params = [
    'location' => '38.863128016469,'.'121.53235931222',
];
try {
    $result = Map::getInstance($config)->geocoder('baidu')->reGeo($params);

    print_r($result);

    // $result['result']['formatted_address']; // 具体地址
    // $result['result']['addressComponent']['country']; // 国家
    // $result['result']['addressComponent']['province']; // 省
    // $result['result']['addressComponent']['city']; // 市
    // $result['result']['addressComponent']['district']; // 区
    // $result['result']['addressComponent']['town']; // 小镇
    // $result['result']['addressComponent']['street']; // 街道
    // $result['result']['addressComponent']['street_number']; // 街道号

} catch (InvalidConfigExceptionAlias $e) {
    echo "配置文件错误：".$e->getMessage();
} catch (InvalidArgumentException $e) {
    echo "参数错误：".$e->getMessage();
} catch (InvalidGatewayExceptionAlias $e) {
    echo "网关或接口返回错误：".$e->getMessage();
}