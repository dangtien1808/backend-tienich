<?php
class Model
{

    function findAll()
    {
        $db = new DataBase();

        $sql = "select * FROM demo";
        $result = $db->fetchAll($sql,[]);

        return $result;
    }
}