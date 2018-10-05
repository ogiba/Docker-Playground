<?php

namespace viewcontroller;

class TestController extends BaseController {

    public function render()
    {
        echo $this->template("view/view_test.php", [

        ]);
    }
}