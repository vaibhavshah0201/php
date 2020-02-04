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

    function fetchCat() {
        $query = "SELECT * FROM category C
                LEFT JOIN parentCategory PC ON
                    C.catParentId = PC.catParentId ";
                $result = mysqli_query($this->con, $query);
        return $result; 
    }

    function fetchAllBlog() {
        $query = "SELECT
                    B.blogId,
                    B.blogTitle,
                    GROUP_CONCAT(C.catParentName) AS category,
                    B.blogPublishAt
                FROM
                    blog_post B
                INNER JOIN post_category P ON
                    B.blogId = P.blogId
                INNER JOIN parentCategory C ON
                    C.catParentId = P.catParentId
                GROUP BY
                    B.blogId";
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
        $query = "DELETE FROM $tableName WHERE $field = $deleteId";
        mysqli_query($this->con, $query);
        return TRUE;
    }
}

?>  