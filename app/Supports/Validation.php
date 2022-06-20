<?php

namespace App\Supports;

use Respect\Validation\Factory;

/**
 * Classe de configuração de validação.
 */
class Validation
{
    /**
     * Executar as configurações padrões.
     *
     * @return void
     */
    public static function run()
    {
        Factory::setDefaultInstance(
            // Tradução das mensagem de validação
            (new Factory())->withTranslator(function (string $message) {
                return self::translator($message);
            })
        );
    }

    /**
     * Retorna as mensagens traduzidas.
     *
     * @param string $message
     * @return array
     */
    private static function translator(string $message)
    {
        return [
            '{{name}} must not be blank' => '{{name}} é obrigatório',
            '{{name}} must have a length lower than or equal to {{maxValue}}' => '{{name}} deve ter menos ou igual de {{maxValue}} caracteres',
            '{{name}} must be positive' => '{{name}} deve ser positivo',
            '{{name}} must be less than or equal to {{compareTo}}' => '{{name}} deve ser menor ou igual a {{compareTo}}'
        ][$message];
    }
}
