<?php

namespace johnxu\map\GatewayInterface;

interface GeocoderInterface
{
    /**
     * 地址编码
     * @param array $params
     * @return mixed
     */
    public function geo(array $params);

    /**
     * 逆向地址编码
     * @param array $params
     * @return mixed
     */
    public function reGeo(array $params);
}