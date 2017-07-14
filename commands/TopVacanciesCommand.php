<?php

namespace commands;

use api\ApiClient;
use application\Application;
use Doctrine\ORM\EntityManager;
use helpers\ArrayHelper;
use helpers\VacancyWordsCounterHelper;
use models\RubricReport;
use models\WordsReport;

/**
 * Class TopVacanciesCommand
 * @package commands
 */
class TopVacanciesCommand extends AbstractConsoleCommand
{
    /**
     * @var ApiClient
     */
    private $apiClient;

    /**
     *
     */
    public function execute()
    {
        $this->apiClient = new ApiClient();
        $geoId = Application::getInstance()->getConfigByKey('geo_id');
        $wordCounterHelper = new VacancyWordsCounterHelper();

        $rubrics = $this->getRubricsList();
        $entityManager = Application::getInstance()->getEntityManager();

        $this->truncateReportsTables($entityManager);

        foreach ($rubrics as $rubric) {
            $rubricId = ArrayHelper::getValue($rubric, 'id', 0);
            $rubricTitle = ArrayHelper::getValue($rubric, 'title', '');
            $vacancies = $this->loadAllVacancies($rubricId, $geoId);
            $vacanciesCount = count($vacancies);

            $rubricReport = new RubricReport();
            $rubricReport->setRubricId($rubricId);
            $rubricReport->setRubricTitle($rubricTitle);
            $rubricReport->setVacanciesCount($vacanciesCount);

            // save report
            $entityManager->persist($rubricReport);
            $entityManager->flush();

            foreach ($vacancies as $vacancy) {
                $header = ArrayHelper::getValue($vacancy, 'header', '');
                $wordCounterHelper->addHeader($header);
            }
        }

        // count words stats
        foreach ($wordCounterHelper as $word => $count) {
            $wordsReport = new WordsReport();
            $wordsReport->setWord($word);
            $wordsReport->setVacanciesCount($count);

            // save report
            $entityManager->persist($wordsReport);
            $entityManager->flush();
        }
    }

    /**
     * Загрузка списка рубрик
     *
     * @return array
     */
    private function getRubricsList()
    {
        $rubrics = [];
        $result = $this->apiClient->call('rubrics');

        foreach ($result->result as $item) {
            $rubrics[] = $item;
        }

        return $rubrics;
    }

    /**
     * Загрузка списка вакансий (рубрика и город)
     *
     * @param $rubricId
     * @param $geoId
     * @param int $offset
     * @return array
     */
    private function loadAllVacancies($rubricId, $geoId, $offset = 0)
    {
        $limit = 100;
        $vacancies = [];
        $response = $this->loadVacancies($rubricId, $geoId, $offset, $limit);

        while (true) {
            foreach ($response->result as $item) {
                $vacancies[] = $item;
            }

            $count = $response->getResultsCount();
            if (!$this->hasNext($count, $limit, $offset))
                break;

            $offset += $limit;
            $response = $this->loadVacancies($rubricId, $geoId, $offset, $limit);
        }

        return $vacancies;
    }

    /**
     * Загрузка части вакансий
     *
     * @param $rubricId
     * @param $geoId
     * @param $offset
     * @param $limit
     * @return \api\response\AbstractResponse
     */
    private function loadVacancies($rubricId, $geoId, $offset, $limit)
    {
        $params = [
            'geo_id' => $geoId,
            'period' => 'today',
            'is_new_only' => 1, // only new vacancies
            'rubric_id[]' => $rubricId,
            'offset' => $offset,
            'limit' => $limit,
        ];

        return $this->apiClient->call('vacancies', $params);
    }

    /**
     * Check if API has more records
     *
     * @param $count
     * @param $limit
     * @param $offset
     * @return bool
     */
    private function hasNext($count, $limit, $offset)
    {
        return $count > ($limit + $offset);
    }

    /**
     * @param EntityManager $entityManager
     */
    private function truncateReportsTables($entityManager)
    {
        $connection = $entityManager->getConnection();
        $platform = $connection->getDatabasePlatform();
        // TODO: remove hard code
        $connection->executeUpdate($platform->getTruncateTableSQL('words_report'));
        $connection->executeUpdate($platform->getTruncateTableSQL('rubric_report'));
    }
}
