<?php 

class Application
{
    public function run()
    {
        $controller = $this->route();

        call_user_func_array([$controller, "render"], []);
    }

    private function route() {
        $a = file_get_contents("route.json");
        $json = json_decode($a, true);

        return new $json["test"]["controller"];
    }
}