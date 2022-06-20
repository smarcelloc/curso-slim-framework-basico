<?php

namespace App\Middleware;

use App\Supports\Sanitizer;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Classe de middleware responsável para higienizar dados de entrada
 */
class SanitizeMiddleware
{
    /**
     * Execução do middleware
     *
     * @param Request $req
     * @param Response $res
     * @param callable $next
     * @return Response
     */
    public function __invoke(Request $req, Response $res, callable $next)
    {
        $query_params = $req->getQueryParams();
        $post_params = $req->getParsedBody();

        // Sanitize para Query Params
        if (is_array($query_params) && count($query_params) > 0) {
            $req_sanitize = $req->withQueryParams($this->sanitize($query_params));
        }

        // Sanitize para Body da requisição
        if (is_array($post_params) && count($post_params) > 0) {
            $req_sanitize = $req->withParsedBody($this->sanitize($post_params));
        }

        return $next($req_sanitize ?? $req, $res);
    }

    /**
     * Definição de dados para a higienização.
     *
     * @param array $params
     * @return array
     */
    private function sanitize(array $params)
    {
        foreach ($params as $key => $value) {
            $params[$key] = Sanitizer::trim($value);

            switch ($key) {
                case 'phone':
                    $params[$key] = Sanitizer::onlyNumber($value);
                    break;
                case 'price':
                    $params[$key] = Sanitizer::onlyNumber($value);
                    break;
                case 'amount':
                    $params[$key] = Sanitizer::onlyNumber($value);
                    break;
            }
        }

        return $params;
    }
}
