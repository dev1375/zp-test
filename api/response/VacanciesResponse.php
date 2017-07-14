<?php

namespace api\response;

/**
 * Class VacanciesResponse
 * @package api\response
 */
class VacanciesResponse extends AbstractResponse
{
    /**
     * VacanciesResponse constructor.
     *
     * @param string $response
     */
    public function __construct($response)
    {
        parent::__construct($response);
        $this->setResult($response['vacancies']);
    }
}
