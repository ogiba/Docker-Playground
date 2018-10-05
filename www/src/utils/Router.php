<?php
namespace utils;

use \ReflectionMethod;

class Router
{
    public function route($path)
    {
        $a = file_get_contents("route.json");
        $routeArray = json_decode($a, true);
        $selectedController = null;

        $explodedPath = explode("/", $path);

        $count = 0;
        foreach ($explodedPath as $pathKey => $pathValue) {
            $count++;

            foreach ($routeArray as $routeKey => $routeValue) {
                $availablePathParts = explode("/", $routeValue["path"]);

                foreach ($availablePathParts as $key => $value) {
                    if (strcmp($value, $pathValue) != 0) {
                        continue;
                    }
                    $selectedController =  $routeValue["controller"];
                }

                if ($selectedController != null
                    && $count == count($explodedPath)) {
                    break;
                }
            }
        }

        $controllerParts = explode("::", $selectedController);

        $reflection = new ReflectionMethod($selectedController);

        return $reflection->invoke(new $controllerParts[0]);
    }
}
