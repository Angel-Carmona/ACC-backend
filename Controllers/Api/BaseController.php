<?php

namespace Controllers\Api;

class BaseController
{
    public static $parseString;
    /**
     * __call magic method.
     */
    public function __call($name, $arguments): void
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }

    /**
     * Get URI elements.
     *
     * @return array
     */
    public static function getUriSegments(): array
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);
        return $uri;
    }
    /**
     * Get querystring params.
     *
     * @return array
     */
    public function getQueryStringParams(): void
    {
        $vars = (object) 
            [
                "vars" => []
            ];

        if (isset($_SERVER['QUERY_STRING'])) {
            $queryString = str_replace('&&', '&', $_SERVER['QUERY_STRING']);
            $queryString = explode('&', $queryString);
            for ($i = 0; $i < count($queryString); $i++) {
                $params = explode('=', $queryString[$i]);
                if (isset($params[1])) {
                    $vars->vars[] = [
                        "name" => $params[0],
                        "value" => $params[1]
                    ];
                }
            }
        }
        self::$parseString = $vars;
    }
    /**
     * Send API output.
     *
     * @param mixed $data
     * @param string $httpHeader
     */
    public function sendOutput($data, $httpHeaders = array()): void
    {
        header_remove('Set-Cookie');
        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }
        exit($data);
    }
}