<?php

namespace application;
use commands\AbstractConsoleCommand;
use commands\MainCommand;
use commands\TopVacanciesCommand;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * Class Application
 * @package application
 */
class Application
{
    /**
     * @var mixed
     */
    private $config;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Application
     */
    private static $instance;

    public function __construct($config)
    {
        // defaults configs for Doctrine ORM
        $ormConfig = Setup::createAnnotationMetadataConfiguration(
            [ __DIR__ . '/models/' ],
            false,
            null,
            null,
            false
        );

        // db connection configuration
        $connectionOptions = $config['db'];

        // get entity manager
        $this->entityManager = EntityManager::create($connectionOptions, $ormConfig);

        // set instance
        static::$instance = $this;
    }

    /**
     * Запуск приложения
     */
    public function run()
    {
        $action = $this->getAction();

        $action->execute();
    }

    /**
     * @return AbstractConsoleCommand|null
     */
    private function getAction()
    {
        /* @var $action AbstractConsoleCommand */
        $action = null;

        if ($_SERVER['argc'] == 2) {
            $commandName = $_SERVER['argv'][1];
            switch ($commandName) {
                case 'rubrics':
                    $action = new TopVacanciesCommand();
                    break;
            }
        }

        if ($action === null)
            $action = new MainCommand();

        return $action;
    }

    /**
     * @param string $key
     * @param mixed $defaultValue
     * @return mixed
     */
    public function getConfigByKey($key, $defaultValue = null)
    {
        if (isset($this->config[$key]))
            return $this->config[$key];

        return $defaultValue;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Singleton method
     *
     * @return static
     */
    public static function getInstance()
    {
        return self::$instance;
    }
}
