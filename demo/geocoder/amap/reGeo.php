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
    'amap_key'  => '575fe342d69c4d94d9325bab3bf08641',
    'baidu_key' => 'f2P4pO8SvOV0ek4O3IkW1GrvF3WHQaDa',
    'qq_key'    => '',
];
$params = [
    'location' => '121.53235931222'.',38.863128016469',
];
try {
    $result = Map::getInstance($config)->geocoder('amap')->reGeo($params);

    print_r($result);

    // $result['regeocode']['formatted_address']; // 具体地址
    // $result['regeocode']['addressComponent']['country']; // 国家
    // $result['regeocode']['addressComponent']['province']; // 省
    // $result['regeocode']['addressComponent']['city']; // 市
    // $result['regeocode']['addressComponent']['district']; // 区
    // $result['regeocode']['addressComponent']['township']; // 乡镇、街道

} catch (InvalidConfigExceptionAlias $e) {
    echo "配置文件错误：".$e->getMessage();
} catch (InvalidArgumentException $e) {
    echo "参数错误：".$e->getMessage();
} catch (InvalidGatewayExceptionAlias $e) {
    echo "网关或接口返回错误：".$e->getMessage();
}