<?php
class Model
{
    protected $tblName;
    protected $db;
    function __construct ($tblName)
    {
        $this->tblName = $tblName;
        $this->db = new DataBase();
    }
    function fetchAll()
    {
        $sql = "select * FROM {$this->tblName}";
        $result = $this->db->fetchAll($sql);
        return $result;
    }

    function fetchId($id)
    {
        $sql = "select * FROM ". $this->tblName . " where id = :id";
        $result = $this->db->fetch($sql, array("id" => $id));
        return $result;
    }
    function fetch($data)
    {
        $lstParams = array();
        foreach ( $data as $key => $val) {
            array_push($lstParams,  $key . " = '" . $val . "' ");
        }
        $sql = "select * FROM ". $this->tblName . " where " . join( "and ", $lstParams);
        $result = $this->db->fetch($sql);
        return $result;
    }
}