<?php 

class Application
{
    public function run()
    {
        $controller = new EmployeeController();
        echo json_encode($controller->loadUsers());
    }
}