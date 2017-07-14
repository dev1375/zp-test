<?php

namespace models;

use Doctrine\ORM\Mapping as ORM;

/**
 * RubricReport
 *
 * @ORM\Table(name="rubric_report")
 * @ORM\Entity
 */
class RubricReport
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
     * @var integer
     *
     * @ORM\Column(name="rubric_id", type="integer", nullable=true)
     */
    private $rubricId;

    /**
     * @var string
     *
     * @ORM\Column(name="rubric_title", type="string", length=255, nullable=true)
     */
    private $rubricTitle;

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
     * Set rubricId
     *
     * @param integer $rubricId
     * @return RubricReport
     */
    public function setRubricId($rubricId)
    {
        $this->rubricId = $rubricId;

        return $this;
    }

    /**
     * Get rubricId
     *
     * @return integer 
     */
    public function getRubricId()
    {
        return $this->rubricId;
    }

    /**
     * Set rubricTitle
     *
     * @param string $rubricTitle
     * @return RubricReport
     */
    public function setRubricTitle($rubricTitle)
    {
        $this->rubricTitle = $rubricTitle;

        return $this;
    }

    /**
     * Get rubricTitle
     *
     * @return string 
     */
    public function getRubricTitle()
    {
        return $this->rubricTitle;
    }

    /**
     * Set vacanciesCount
     *
     * @param integer $vacanciesCount
     * @return RubricReport
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
