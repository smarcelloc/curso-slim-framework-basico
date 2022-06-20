<?php

namespace App\Supports;

use App\Supports\HandlerError\CustomExceptionHandler;
use App\Supports\HandlerError\CustomNotAllowedHandler;
use App\Supports\HandlerError\CustomNotFoundHandler;
use App\Supports\HandlerError\CustomPhpErrorHandler;
use Slim\Container;

/**
 * Classe de setup da aplicação
 */
class Application extends \Slim\App
{
    /**
     * Configuração do sistema.
     *
     * @var array
     */
    private $config = [];

    /**
     * Construtor da classe
     * 
     * @param ContainerInterface|array|null $container
     * @throws InvalidArgumentException When no container is provided that implements ContainerInterface
     */
    public function __construct($container = null)
    {
        if (!is_null($container)) {
            parent::__construct($container);
            return;
        }

        // Definição de configuração padrão.
        $this->setConfig();
        $container = new Container($this->config);

        // Configuração dos handlers de Erros
        $container['errorHandler'] = function () {
            return new CustomExceptionHandler();
        };

        $container['notFoundHandler'] = function () {
            return new CustomNotFoundHandler();
        };

        $container['phpErrorHandler'] = function () {
            return new CustomPhpErrorHandler();
        };

        $container['notAllowedHandler'] = function () {
            return new CustomNotAllowedHandler();
        };

        parent::__construct($container);
    }

    /**
     * Configuração do Slim Framework
     * 
     * @return void
     * @see https://www.slimframework.com/docs/v3/objects/application.html#slim-default-settings
     */
    public function setConfig()
    {
        $this->config = [
            'settings' => [
                'displayErrorDetails' => !isProduction(),
                'routerCacheFile' => isProduction() ? PATH['cache'] . '/routes.php' : false,
                // 'doctrine' => [
                //     'dev_mode' => !isProduction(),
                //     'cache_dir' => PATH['cache'] . '/db',
                //     'connection' => DB
                // ],
            ],
        ];
    }
}
