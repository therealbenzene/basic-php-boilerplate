<?php

namespace App\Base\Request;

class Request implements IRequest
{

    private $body = [];

    function __construct()
    {
        $this->bootstrapSelf();
    }

    private function bootstrapSelf()
    {
        foreach ($_SERVER as $key => $value) {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    private function toCamelCase($string)
    {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);

        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }

        return $result;
    }

    public function getBody()
    {
        if ($this->requestMethod === "GET") {
            return [];
        }


        if ($this->requestMethod == "POST") {

            $this->body = array();
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }

            return $this->body;
        }
    }

    public function get($name = '')
    {
        if (empty($this->body)) $this->body = $this->getBody();

        $body = $this->body;

        if (empty($name))
            return "";

        if (isset($body[$name])) {
            # code...
            return $body[$name];
        }

        return "";
    }
}
