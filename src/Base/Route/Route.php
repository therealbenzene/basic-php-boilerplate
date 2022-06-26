<?php

namespace App\Base\Route;

use App\Base\Request\Request;

class Route
{
    private static $request;
    private static $routes;
    private static $supportedHttpMethods = array(
        "GET",
        "POST"
    );

    static function __callStatic($name, $args)
    {
        self::$request = new Request();

        list($route, $method) = $args;

        if (!in_array(strtoupper($name), self::$supportedHttpMethods)) {
            self::invalidMethodHandler();
        }

        self::$routes[strtolower($name)] = [self::formatRoute($route) => $method];
        self::resolve();
    }

    /**
     * Removes trailing forward slashes from the right of the route.
     * @param route (string)
     */
    private static function formatRoute($route)
    {
        $result = rtrim($route, '/');
        if ($result === '') {
            return '/';
        }
        return $result;
    }

    private static function invalidMethodHandler()
    {
        $serverProtocol = self::$request->serverProtocol;
        header("{$serverProtocol} 405 Method Not Allowed");
    }

    private static function resourceNotFoundHandler()
    {
        $serverProtocol = self::$request->serverProtocol;
        header("{$serverProtocol} 404 Not Found");
    }

    private static function resourceOKHandler()
    {
        $serverProtocol = self::$request->serverProtocol;
        header("{$serverProtocol} 200 OK");
    }

    /**
     * Resolves a route
     */
    private static function resolve()
    {
        $methodDictionary = self::$routes[strtolower(self::$request->requestMethod)];
        $formatedRoute = self::formatRoute(self::$request->requestUri);

        self::resourceOKHandler();

        if (!isset($methodDictionary[$formatedRoute])) {
            self::resourceNotFoundHandler();
            return;
        }

        $method = $methodDictionary[$formatedRoute];

        if (is_null($method)) {
            self::resourceNotFoundHandler();
            return;
        }

        echo call_user_func_array($method, array(new Request()));
        exit;
    }
}
