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

    // taking whatever name and making it [eg: serverName]
    private function toCamelCase($string)
    {
        /**
         * eg:
         *  SERVER_NAME => server_name
         *  SERVER_NAME_COUNT => server_name_count
         ***/
        $result = strtolower($string);

        /** 
         * eg:
         *  server_name => [_n]
         *  server_name_count => [_n,_c]
         ***/
        preg_match_all('/_[a-z]/', $result, $matches);

        // loop 
        foreach ($matches[0] as $match) {
            // _n => N
            $c = str_replace('_', '', strtoupper($match));

            // search(_n), repalce(N), in(server_name) => serverName
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
