<?php
class DbConnect {

    private $hostName = "localhost";
    private $databaseName = "customer_portal";
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
        $value = implode(",",array_values($data));
        $query = "INSERT INTO $tableName ($fields) VALUES ($value)";
        mysqli_query($this->con, $query);
        return mysqli_insert_id($this->con);
    }

    function fetchAll() {
        $query = "SELECT C.customerId, 
                        C.customerFirstName, 
                        C.customerLastName,
                        CA.custAddCompany,
                        HOBB.custInfoFieldValue AS hobbie,
                        GET_IN.custInfoFieldValue AS getTouch
        FROM customers C 
        LEFT JOIN customer_address CA 
            ON C.customerId = CA.customerId
        LEFT JOIN customer_additional_info HOBB 
            ON C.customerId = HOBB.customerId AND HOBB.custInfoFieldKey = 'hobbies'
        LEFT JOIN customer_additional_info GET_IN
            ON C.customerId = GET_IN.customerId AND GET_IN.custInfoFieldKey = 'getTouch'";
        $result = mysqli_query($this->con, $query);
        return $result;    
    }

    function fetchRow($tableName, $condition) {
        $query = "SELECT * FROM $tableName WHERE $condition";
        $result = mysqli_query($this->con, $query);
        return $result; 
    }

    function update($data, $tableName, $field, $id) {
        foreach ($data as $key => $value) {
            echo $query = "UPDATE $tableName SET $key = $value WHERE $field = $id"; 
            // mysqli_query($this->con, $query);
            echo "<br>";
        }
        return TRUE;
    }
    

}
?>