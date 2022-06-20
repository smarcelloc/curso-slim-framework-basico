<?php

/**
 * Config.php
 * 
 * Arquivo de configuração e definição de variáveis globais.
 */

// Diretório root do sistema.
$dir_root = dirname(__DIR__);

// Carregamento das variáveis de ambientes do arquivo .env
$dotenv = \Dotenv\Dotenv::createImmutable($dir_root);
$dotenv->load();
$dotenv->required('APP_NAME')->notEmpty();
$dotenv->required('APP_ENV')->notEmpty()->allowedValues(['local', 'production']);

// =============================================================================
// DEFINIÇÃO DO SISTEMA
// =============================================================================

// Definição de caminho dos diretórios
define('PATH', [
    'root' => $dir_root,
    'app' => $dir_root . '/app',
    'cache' => $dir_root . '/cache',
    'public' => $dir_root . '/public'
]);

// Definição de configuração da aplicação
define('APP', [
    'name' => $_ENV['APP_NAME'],
    'version' => $_ENV['APP_VERSION'] ?? 'v1.0.0',
    'env' => $_ENV['APP_ENV'],
    'charset' => 'UTF-8'
]);

// Definições de conexão a base de dados
define('DATABASE', [
    'driver' => $_ENV['DB_DRIVER'],
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'dbname' => $_ENV['DB_NAME'],
    'user' => $_ENV['DB_USER'] ?? null,
    'password' => $_ENV['DB_PASSWORD'] ?? null,
    'charset' => 'utf8'
]);

// =============================================================================
// CONFIGURAÇÃO INICIAL DO SISTEMA
// =============================================================================

// Não exibir as tags de HTML quando lança um erro.
ini_set('html_errors', 0);

// Charset da aplicação
ini_set('default_charset', APP['charset']);

// Configuração para o ambiente de produção
if (APP['env'] === 'production') {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    header_remove('X-Powered-By');
}

// Configuração padrão de validação
\App\Supports\Validation::run();
