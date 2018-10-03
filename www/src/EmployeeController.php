<?php

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
        // $link = mysqli_connect("db", "user", "test", "myDb");

        // if (!$link) {
        //     echo "Error: Unable to connect to MySQL." . PHP_EOL;
        //     echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        //     echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        //     exit;
        // }

        // echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
        // echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

        // mysqli_close($link);
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
