<?php

namespace viewcontroller;

class IndexController extends BaseController
{
    public $param = "A";

    public function render()
    {
        echo $this->template("view/view_index.php", [
            "testParam" => $this->param
        ]);
    }
}
