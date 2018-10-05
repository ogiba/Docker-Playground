<?php

namespace controller;

class EmployeeController
{
    public function loadUsers()
    {
        $conn = $this->createConnection();
        $stmt = $conn->prepare("SELECT * FROM employees");
        $stmt->execute();
        
        $data = $this->bindResult($stmt);
        $result = array();

        while ($stmt->fetch()) {
            $result[] = array("id" => $data["id"]);
        }

        $conn->close();
        return $result;
    }

    /**
     * @return \mysqli
     */
    private function createConnection()
    {
        $mySql = mysqli_connect("db", "user", "test", "myDb");
        $mySql->set_charset("utf8");
        return $mySql;
    }
    
    protected function &bindResult($stmt)
    {
        $variables = array();
        $data = array();
        $meta = $stmt->result_metadata();
        $d = false;

        if ($meta == null) {
            return $d;
        }

        while ($field = $meta->fetch_field()) {
            $variables[] = &$data[$field->name];
        } // pass by reference

        call_user_func_array(array($stmt, 'bind_result'), $variables);

        return $data;
    }
}
