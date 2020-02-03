<?php
class DbConnect {

    private $hostName = "localhost";
    private $databaseName = "blog";
    private $userName = "root";
    private $userPassword = "";
    private $con;

    function __construct() {
       $this->con = $this->connect();
       if(! $this->con ){
            die('Could not connect: ' . mysqli_error());
        }
    }

    function connect() {
        $this->con = mysqli_connect($this->hostName,$this->userName,$this->userPassword,$this->databaseName);
        return $this->con;
    }

    function insert($data, $tableName) {
        $fields = implode(",",array_keys($data));
        $value = implode("','",array_values($data));
        $query = "INSERT INTO $tableName ($fields) VALUES ('$value')";
        mysqli_query($this->con, $query);
        return mysqli_insert_id($this->con);
    }

    function fetchRow($tableName, $condition) {
        $query = "SELECT * FROM $tableName WHERE $condition";
        $result = mysqli_query($this->con, $query);
        return $result; 
    }

    function fetchAll($tableName, $fields) {
        $query = "SELECT $fields FROM $tableName";
        $result = mysqli_query($this->con, $query);
        return $result; 
    }

    function update($data, $tableName, $condition) {
        foreach ($data as $key => $value) {
            $query = "UPDATE $tableName SET $key = '$value' WHERE $condition"; 
            mysqli_query($this->con, $query);
        }
        return TRUE;
    }

    function delete($tableName, $field, $deleteId) {
        echo $query = "DELETE FROM $tableName WHERE $field = $deleteId";
        mysqli_query($this->con, $query);
        return TRUE;
    }
}

?>