<?php

namespace helpers;

/**
 * Class VacancyWordsCounterHelper
 * @package helpers
 */
class VacancyWordsCounterHelper implements \IteratorAggregate, \ArrayAccess, \Countable
{
    /**
     * @var array of words
     */
    private $items = [];

    /**
     *
     * @param string $header
     */
    public function addHeader($header)
    {
        $words = $this->getWordsArray($header);

        foreach ($words as $word) {
            if ($this->offsetExists($word)) {
                $this->items[$word] += 1;
            } else {
                $this->items[$word] = 1;
            }
        }
    }

    /**
     * Метод отделения слов
     *
     * @param $header
     * @return array
     */
    private function getWordsArray($header)
    {
        $header = mb_strtolower($header);
        $header = preg_replace('/([^\w\s]+)/ui', '', $header);
        $header = preg_replace('/\s{2,}/ui', ' ', $header);
        $header = trim($header);

        $words = explode(' ', $header);
        $words = array_unique($words);

        return $words;
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset))
            return $this->items[$offset];

        return null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}