<?php

namespace api\response;

/**
 * Class RubricsResponse
 * @package api\response
 */
class RubricsResponse extends AbstractResponse
{
    /**
     * RubricsResponse constructor.
     *
     * @param string $response
     */
    public function __construct($response)
    {
        parent::__construct($response);
        $this->setResult($response['rubrics']);
    }
}
