<?php

namespace controller;

class IndexController extends BaseController
{
    public $param = "A";

    public function render()
    {
        echo $this->template("view/indexView.php", [
            "testParam" => $this->param
        ]);
    }
}
