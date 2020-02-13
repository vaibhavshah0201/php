<?php

/* Post Model */
namespace App\Models;

use PDO;

class Post extends \Core\Model{
    
    /*Get All the posts */

    public static function getAll() {
        try{
            $db = static::getDB();
            $stmt = $db->query("SELECT id, title, content FROM posts ORDER BY createAt");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function insertPost($data) {
        try{
            
            $db = static::getDB();
            $stmt = $db->prepare("INSERT INTO posts(title, content) VALUES(?, ?)");
            $db->beginTransaction();
            $stmt->execute( array_values($data));
            $id = $db->lastInsertId();
            return $id;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}