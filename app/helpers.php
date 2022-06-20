<?php

/**
 * Helpers.php
 * 
 * Contém funções globais para auxiliares no desenvolvimento do sistema.
 */

/**
 * Retorna se aplicação está localmente.
 *
 * @return boolean true (sim) / false (não)
 */
function isLocal()
{
    return APP['env'] === 'local';
}


/**
 * Retorna se aplicação está em produção.
 * 
 * @return boolean true (sim) / false (não)
 */
function isProduction()
{
    return APP['env'] === 'production';
}

/**
 * Retorna a padronização da Exception em um array.
 *
 * @param Throwable $th
 * @return array
 */
function getException(Throwable $th)
{
    return [
        'class' => get_class($th),
        'message' => $th->getMessage(),
        'code' => $th->getCode(),
        'file' => $th->getFile(),
        'trace' => $th->getTraceAsString()
    ];
}
