<?php
namespace utils;

class Router
{
    public function route($path)
    {
        $a = file_get_contents("route.json");
        $routeArray = json_decode($a, true);
        $selectedController = null;

        $explodedPath = explode("/", $path);

        foreach ($routeArray as $routeKey => $routeValue) {
            $availablePathParts = explode("/", $routeValue["path"]);

            foreach ($availablePathParts as $partKey => $partValue) {
                foreach ($explodedPath as $key => $value) {
                    if (strcmp($value, $partValue) != 0) {
                        continue;
                    }
                    $selectedController =  $routeValue["controller"];
                    break;
                }
            }
        }

        return new $selectedController;
    }
}
