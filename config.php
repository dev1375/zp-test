<?php

return [
    'geo_id' => 826, // GEO Id of Novosibirsk city, via https://api.zp.ru/v1/geo/
    'db' => [
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => '',
        'dbname'   => 'reports',
        'driverOptions' => [
            1002 => 'SET NAMES utf8'
        ]
    ]
];
