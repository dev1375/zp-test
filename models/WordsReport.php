<?php

namespace models;

use Doctrine\ORM\Mapping as ORM;

/**
 * WordsReport
 *
 * @ORM\Table(name="words_report")
 * @ORM\Entity
 */
class WordsReport
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="word", type="string", length=255, nullable=false)
     */
    private $word;

    /**
     * @var integer
     *
     * @ORM\Column(name="vacancies_count", type="integer", nullable=false)
     */
    private $vacanciesCount;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set word
     *
     * @param string $word
     * @return WordsReport
     */
    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word
     *
     * @return string 
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set vacanciesCount
     *
     * @param integer $vacanciesCount
     * @return WordsReport
     */
    public function setVacanciesCount($vacanciesCount)
    {
        $this->vacanciesCount = $vacanciesCount;

        return $this;
    }

    /**
     * Get vacanciesCount
     *
     * @return integer 
     */
    public function getVacanciesCount()
    {
        return $this->vacanciesCount;
    }
}
