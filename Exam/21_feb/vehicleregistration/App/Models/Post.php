<?php

/* Post Model */
namespace App\Models;

use PDO;

class Post extends \Core\Model{

    protected static $table = 'posts';
    protected static $primaryKey = 'id';
    
    /*Get All the posts */

    public static function getAll() {
        try{
            $db = static::getDB();
            $stmt = $db->query("SELECT id, title, content FROM posts ORDER BY id");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function insertPost($data) {
        try{
            $key = array_keys($data);
            $value = array_values($data);
            parent::insert($key, $value);
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function fetchRow($id) {
        try{
            $db = static::getDB();
            $stmt = $db->query("SELECT id, title, content FROM posts WHERE id = $id");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function deletePost($id){
        try{

            $db = static::getDB();  
            $stmt = $db->query("DELETE FROM posts WHERE id = $id");
            return $stmt->rowCount(PDO::FETCH_ASSOC);

        } catch (PDOException $e) { 
            echo $e->getMessage();
        }

    }

    public static function updatePost($data, $id){
        try{
            $filterData = [];
            $keyValue = [];
            foreach($data as $key => $value) {
                switch($key) {
                    case 'txtTitle':
                        $filterData['title'] = $value;
                    break;

                    case 'txtContent':
                        $filterData['content'] = $value;
                    break;
                }
            }
            foreach($filterData as $key => $value) {
                array_push($keyValue, "$key = '$value'");
            }
            $keyValue = implode(", ", $keyValue);
            $db = static::getDB();  
            $stmt = $db->query("UPDATE posts SET $keyValue WHERE id=$id");
            return $stmt->rowCount();

        } catch (PDOException $e) { 
            echo $e->getMessage();
        }
    }
}