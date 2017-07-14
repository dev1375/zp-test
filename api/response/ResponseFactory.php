<?php

namespace api\response;

/**
 * Class ResponseFactory
 * @package api\response
 */
class ResponseFactory
{
    /**
     * @param string $response
     * @return AbstractResponse
     * @throws \Exception
     */
    public static function build($response)
    {
        $response = json_decode($response, true);

        if (isset($response['vacancies']))
            return new VacanciesResponse($response);

        if (isset($response['rubrics']))
            return new RubricsResponse($response);

        throw new \Exception('Unknown response.');
    }
}