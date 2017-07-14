<?php

namespace api;

use api\response\AbstractResponse;
use api\response\ResponseFactory;

/**
 * Класс для работы с API zp.ru
 * Class ZPApi
 */
class ApiClient
{
    /**
     * Адрес API
     */
    const API_HOST = 'https://api.zp.ru';

    /**
     * Версия API
     *
     * @var string
     */
    private $version = 'v1';

    /**
     * ZPApi constructor.
     *
     * @param string $version
     */
    public function __construct($version = 'v1')
    {
        $this->version = $version;
    }

    /**
     * Выполнение запроса к API
     *
     * @param string $method Навзание метода
     * @param array $params Параметры запроса
     * @return AbstractResponse
     */
    public function call($method, $params = [])
    {
        $url = $this->getUrl($method, $params);
        $result = $this->doRequest($url);

        return ResponseFactory::build($result);
    }

    /**
     * Метод выполнения GET запроса
     *
     * @param $url
     * @return string
     */
    private function doRequest($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    /**
     * Возвращает URL для запроса
     *
     * @param $method
     * @param array $params
     * @return string
     */
    private function getUrl($method, $params = [])
    {
        $url = sprintf('%s/%s/%s/?',
            self::API_HOST,
            $this->version,
            $method
        );
        $url .= http_build_query($params);

        return $url;
    }
}
