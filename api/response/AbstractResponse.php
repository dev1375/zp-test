<?php

namespace api\response;

/**
 * Class AbstractResponse
 * @package api\response
 */
abstract class AbstractResponse
{
    /**
     * Мета
     *
     * @var array
     */
    public $metadata;

    /**
     * Результат
     *
     * @var array
     */
    public $result;

    /**
     * AbstractResponse constructor.
     * @param string $response
     */
    public function __construct($response)
    {
        $this->setMetadata($response['metadata']);
    }

    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     * @param array $result
     */
    protected function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * Возвращает количество записей
     *
     * @return int
     */
    public function getResultsCount()
    {
        if (isset($this->metadata['resultset']['count']))
            return $this->metadata['resultset']['count'];

        return 0;
    }
}
