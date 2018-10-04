<?php 

use controller\IndexController;

class Application
{
    public function run()
    {
        $controller = new IndexController();
        $controller->render();
    }
}