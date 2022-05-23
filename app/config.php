<?php

/**
 * Configuração dos caminhos de diretórios.
 */
$dirRoot = dirname(__FILE__, 2);
define('PATH', [
    'root' => $dirRoot,
    'app' => $dirRoot . '/app',
    'entities' => $dirRoot . '/app/Entities',
    'controllers' => $dirRoot . '/app/Controllers',
    'repositories' => $dirRoot . '/app/Repositories'
]);

/**
 * Carregamento do arquivo .env
 */
\Dotenv\Dotenv::createImmutable(PATH['root'])->load();

/**
 * Configuração da API.
 */
define('APP', [
    'name' => $_ENV['APP_NAME'] ?? 'slim',
    'version' => $_ENV['APP_VERSION'] ?? '1',
    'env' => $_ENV['APP_ENV'] ?? 'local'
]);

/**
 * Parâmetros do banco de dados para conexão.
 */
define('DB', [
    'driver'   => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
    'host' => $_ENV['DB_HOST'] ?? 'localhost',
    'port' => $_ENV['DB_PORT'] ?? '3306',
    'user'     => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'dbname'   => $_ENV['DB_NAME'],
]);
