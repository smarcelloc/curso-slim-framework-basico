<?php

/**
 * Funções auxiliares globais.
 */

/**
 * Checa se aplicação é local.
 *
 * @return boolean
 */
function isLocal(): bool
{
    return APP['env'] === 'local';
}
