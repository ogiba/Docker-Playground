<?php 

use utils\Router;

class Application
{
    public function run()
    {
        $path = "";
        if (isset($_GET["path"])) {
            $path = $_GET["path"];
        }

        $router = new Router();
        echo $router->route($path);

        // call_user_func($controller);
        // call_user_func_array([$controller, "render"], []);
    }
}